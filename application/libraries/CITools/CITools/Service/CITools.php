<?php

namespace CITools\Service;

use CITools\Template\Adapter\TemplateInterface;

use CITools\Template\CodeigniterTemplate;

class CITools
{


    public static $appDir;

    /**
     * Folder "assets" localization
     *
     */
    public static $assets_dir = '../assets/';

    /**
     * Css directory in assets
     *
     * @var string
     */
    public static $css_dir = 'css/';

    /**
     * Sass directory in assets
     *
     * @var string
     */
    public static $sass_dir  = 'css/sass/';

    /**
     * Less directory in assets
     *
     * @var string
     */
    public static $less_dir  = 'css/less/';

    /**
     * Javascript directory in assets
     *
     * @var string
     */
    public static $js_dir  = 'js/';

    /**
     * Coffescript directory in assets
     *
     * @var string
     */
    public static $coffee_dir  = 'js/coffee/';

    /**
     * Content of generate file
     */
    public static $content;

    /**
     * As a convenience, fetch popular assets for user
     *
     * php ci-tools generator:assets jquery.js
     */
    public static $external_assets = array(
        // JavaScripts
        'jquery.js' => 'http://code.jquery.com/jquery.min.js',
        'backbone.js' => 'http://backbonejs.org/backbone.js',
        'underscore.js' => 'http://underscorejs.org/underscore.js',
        'handlebars.js' => 'http://cloud.github.com/downloads/wycats/handlebars.js/handlebars-1.0.rc.1.js',
        'jasmine-jquery.js' => 'https://raw.github.com/velesin/jasmine-jquery/master/lib/jasmine-jquery.js',
        'live.js' => 'http://livejs.com/live.js',
        // CSS
        'normalize.css' => 'https://raw.github.com/necolas/normalize.css/master/normalize.css',
        'reset.css' => 'http://meyerweb.com/eric/tools/css/reset/reset200802.css'
    );

    /**
     * Running the file in command line
     *
     * @param array $arguments var $argv [http://php.net/manual/pt_BR/reserved.variables.argv.php]
     * @return type
     */
    public function run(array $arguments){

        self::$appDir = CodeigniterTemplate::getApplicationDirectory();
        //self::$assets_dir = self::$appDir . self::$assets_dir;

        if ( ! isset($arguments[0]))
            throw new \Exception("Please choice a option.\n" . $this->help());

        list($task, $method) = $this->parse($arguments[0]);
        // Once the bundle has been resolved, we'll make sure we could actually
        // find that task, and then verify that the method exists on the task
        // so we can successfully call it without a problem.
        if (is_null($task))
            throw new \Exception("Sorry, I can't find that task.");

        if ( !is_callable(array($this, $method)) )
            throw new \Exception("Sorry, I can't find that method!");

        $this->$method(array_slice($arguments, 1));
    }

    /**
     * Parse the task name to extract the bundle, task, and method.
     *
     * @param string $task
     * @return array
     */
    protected static function parse($task)
    {

        // Extract the task method from the task string. Methods are called
        // on tasks by separating the task and method with a single colon.
        // If no task is specified, "run" is used as the default.
        if (strpos($task, 'generator:') !== FALSE){
            list($task, $method) = explode('generator:', $task);
        }else{
            $method = 'help';
        }
        return array($task, $method);
    }

    /**
     * Methods aliases
     *
     */
    public function c($args)   { return $this->controller($args); }
    public function m($args)   { return $this->model($args); }
    public function mig($args) { return $this->migration($args); }
    public function v($args)   { return $this->view($args); }
    public function a($args)   { return $this->assets($args); }
    public function t($args)   { return $this->test($args); }
    public function r($args)   { return $this->resource($args); }

    /**
     * Printing help info with implemented methods.
     *
     */
    public function help()
    {
        echo <<<EOT
\n=============  GENERATOR COMMANDS  =============\n
generator:controller [name] [methods]
generator:model [name] [methods]
generator:view [view]
generator:assets [asset]
\n=====================  END  ====================\n
EOT;
    }

    /**
     * Generator a controller file with optional actions.
     *
     * HOW TO USE:
     *
     * php ci-tools generator:controller Admin
     * php ci-tools generator:controller Admin index edit
     *
     * @param array $args
     * @return string
     */
    public function controller($args)
    {
        if ( empty($args) ) {
            throw new \Exception("Error: Please supply a class name, and your desired methods.\n");
        }

        // Name of the class and file
        $class_name = ucwords(array_shift($args));

        // Where will this file be stored?
        $file_path = __DIR__ . self::$appDir . 'controllers'. DIRECTORY_SEPARATOR . "$class_name.php";

        // Begin building up the file's content
        self::$content = CodeigniterTemplate::generatorClass($class_name, 'CI_Controller');
        $content = '';
        // Now we filter through the args, and create the funcs.
        foreach($args as $method) {
            $content .= CodeigniterTemplate::generatorFunction("{$method}");
        }

        // Add methods/actions to class.
        self::$content = $this->add_after('{', $content, self::$content);
        // Prettify
        $this->prettify();
        // Create the file
        $this->write_to_file($file_path);

    }

    /**
     * Generator a model file
     *
     * HOW TO USE:
     *
     * php ci-tools generator:model User
     * php ci-tools generator:model User getUsers
     *
     * @param array $args
     * @return string
     */
    public function model($args)
    {

        // Name of the class and file
        $class_name = ucwords(array_shift($args));

        $file_path = __DIR__ . self::$appDir . 'models'. DIRECTORY_SEPARATOR . str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $class_name) . '.php';

        // Begin building up the file's content
        self::$content = CodeigniterTemplate::generatorClass($class_name, 'CI_Model');
        $content = '';
        // Now we filter through the args, and create the funcs.
        foreach($args as $method) {
            $content .= CodeigniterTemplate::generatorFunction("{$method}");
        }

        // Add methods/actions to class.
        self::$content = $this->add_after('{', $content, self::$content);
        // Prettify
        $this->prettify();
        // Create the file
        $this->write_to_file($file_path);
    }

    /**
     * Create any number of views
     *
     * USAGE:
     *
     * php ci-tools generator:view index
     * php ci-tools generator:view index add edit
     *
     * @param array $args
     * @return bool
     */
    public function view($paths)
    {
        if ( empty($paths) ) {
            throw new \Exception("Warning: no views were specified. Add some!\n");
        }

        foreach( $paths as $path ) {
            $file_path = __DIR__ . self::$appDir . 'views'. DIRECTORY_SEPARATOR . str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $path) . '.php';

            self::$content = "This is the $file_path view";
            $this->write_to_file($file_path);
        }
        return true;
    }

    /**
     * Write the contents to the specified file
     *
     * @param string $file_path File path
     * @param string $success Default return printed for in command line Cli
     * @return type
     */
    protected function write_to_file($file_path,  $success = '')
    {
        $success = $success ?: "[X] Created: $file_path.\n\n";

        if ( file_exists($file_path) ) {
            // we don't want to overwrite it
            throw new \Exception("Warning: File already exists at $file_path\n");
        }

        if( !is_dir(dirname($file_path))){
            mkdir(dirname($file_path));
        }

        if ( file_put_contents($file_path, self::$content) !== false ) {
            echo $success;
            return;
        }

        echo "[ ] Whoops - something wrong! I can't create file in $file_path \n";
    }

    /**
     * Crazy sloppy prettify. TODO - Cleanup
     *
     * @param  $content string
     * @return string
     */
    protected function prettify()
    {
        $content = self::$content;

        $content = str_replace('<?php ', "<?php ", $content);
        $content = str_replace('{}', "\n{\n\n}", $content);
        $content = str_replace("() \n{\n\n}", "()\n\t{\n\n\t}", $content);
        $content = str_replace('}}', "}\n\n}", $content);

        // Migration-Specific
        $content = preg_replace('/ ?Schema::/', "\n\t\tSchema::", $content);
        $content = preg_replace('/\$table(?!\))/', "\n\t\t\t\$table", $content);
        $content = str_replace('});}', "\n\t\t});\n\t}", $content);
        $content = str_replace(');}', ");\n\t}", $content);
        $content = str_replace("() {", "()\n\t{", $content);

        self::$content = trim($content);
    }


    public function add_after($where, $to_add, $content)
    {
        // return preg_replace('/' . $where . '/', $where . $to_add, $content, 1);
        return str_replace($where, $where . $to_add, $content);
    }

    /**
     * Create assets in the public directory
     *
     * USAGE:
     * php ci-tools generator:assets style1.css some_module.js
     *
     * @param  $assets aarray
     * @return void
     */
    public function asset($assets) { return $this->assets($assets); }
    public function assets($assets)
    {
        if( empty($assets) ) {
            echo "Please specify the assets that you would like to create.";
            return;
        }

        foreach( $assets as $asset ) {

            if( !$this->getExtension($asset) ) {
                throw new \Exception("Warning: Could not determine file type. Please specify an extension.");
            }

            // Set the path, dependent upon the file type.
            $path = $this->getFileAssetsDirectory($asset);

            if ( $this->is_external_asset($asset) ) {
                $this->fetch($asset);
            } else {
                self::$content = '';
            }

            $this->write_to_file(__DIR__ . self::$appDir . self::$assets_dir . $path, '');
        }
    }

    /**
     * Get file extension
     *
     * @param string $file_name
     * @return string
     */
    public function getExtension($file_name){
        // Grab the file extension
        $x = explode('.', $file_name);
        return end($x);
    }

    /**
     * Get assets directory by the extension file
     *
     * @param int $file_name file name
     * @return string
     */
    public function getFileAssetsDirectory($file_name)
    {

        $ext = $this->getExtension($file_name);
        // Set the path, dependent upon the file type.
        switch ($ext) {
            case 'js':
                $path = self::$js_dir . $file_name;
                break;

            case 'coffee':
                $path = self::$coffee_dir . $file_name;
                break;

            case 'scss':
            case 'sass':
                $path = self::$sass_dir . $file_name;
                break;

            case 'less':
                $path = self::$less_dir . $file_name;
                break;

            case 'css':
            default:
                $path = self::$css_dir . $file_name;
                break;
        }
        return $path;
    }

    /**
     * Determines whether the asset that the user wants is
     * contained with the external assets array
     *
     * @param $assets string
     * @return boolean
     */
    protected function is_external_asset($asset)
    {
        return array_key_exists(strtolower($asset), static::$external_assets);
    }


    /**
     * Fetch external asset
     *
     * @param $url string
     * @return string
     */
    protected function fetch($url)
    {
       self::$content = file_get_contents(static::$external_assets[$url]);
       return self::$content;
    }

}