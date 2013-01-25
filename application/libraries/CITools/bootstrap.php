<?php

/* Include path */
set_include_path(implode(PATH_SEPARATOR, array(
    __DIR__ . '../../libraries/CITools' ,
    get_include_path(),
)));

/* PSR-0 autoloader */
spl_autoload_register(
    function($className) {
        $filename = strtr($className, '\\', DIRECTORY_SEPARATOR) . '.php';
        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
            $path .= DIRECTORY_SEPARATOR . $filename;
            if (is_file($path)) {
                echo $path."\n";
                require_once $path;
                return true;
            }
        }
        return false;
    }
);