<?php

namespace CITools\Template;

use CITools\Template\Adapter\TemplateInterface as TemplateInterface;

final class CodeigniterTemplate implements TemplateInterface {

    public static function getApplicationDirectory(){
        $applicationDirectory = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        return $applicationDirectory;
    }
    /**
     * Generate a function for template generated
     * @param string $func_name function name
     * @return type
     */
    public static function generatorFunction($func_name)
    {
        return <<<EOT

    /**
     * Description
     * @return type
     */
    public function {$func_name}()
    {
        //  Insert code here!
    }

EOT;
    }

    /**
     * Generator class with your extended class
     * @param string $name
     * @param string $extends_class
     * @return type
     */
    public static function generatorClass($name, $extends_class = null)
    {
        $content = "
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class $name";
        if ( !empty($extends_class) ) {
            $content .= " extends $extends_class";
        }

        $content .= ' {}';

        return $content;
    }

}