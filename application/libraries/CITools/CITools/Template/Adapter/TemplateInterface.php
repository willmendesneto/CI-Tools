<?php

namespace CITools\Template\Adapter;

interface TemplateInterface {

    public static function generatorFunction($func_name);

    public static function generatorClass($name, $extends_class = null);

	public static function getApplicationDirectory();
}