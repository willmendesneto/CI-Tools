<?php

namespace CITools\Config;

use CITools\Config\Adapter\ConfigInterface as ConfigInterface;

final class CodeigniterConfig implements ConfigInterface {

    public static $alphaNumeric = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public static $length = 32;

    public static function generatorEncriptionKey(){
        return substr(str_shuffle(str_repeat(static::$alphaNumeric, 10)), 0, static::$length);
    }

}