<?php


namespace CITools\Template\Adapter;

interface TemplateInterface {


    public static function generatorFunction($func_name);

    /**
     * Generator class with your extended class
     * @param string $name
     * @param string $extends_class
     * @return type
     */
    public static function generatorClass($name, $extends_class = null);

}