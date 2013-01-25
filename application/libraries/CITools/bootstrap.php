<?php

/* Include path */
set_include_path(implode(PATH_SEPARATOR, array(
    CITOOLS_DIR ,
    get_include_path(),
)));

/* PEAR autoloader */
spl_autoload_register(
    function($className) {
        $filename = strtr($className, '\\', DIRECTORY_SEPARATOR) . '.php';
        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
            $path .= DIRECTORY_SEPARATOR . $filename;
            if (is_file($path)) {
                require_once $path;
                return true;
            }
        }
        return false;
    }
);

echo '<pre>';
 var_dump(CITOOLS_DIR);
 var_dump(get_included_files());
 echo '</pre>';
    $generate = new \CITools\Service\CITools();

 die('finally');
