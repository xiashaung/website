<?php

/**
 * Created by PhpStorm.
 * User: xiashuang
 * Date: 2018/2/28
 * Time: 14:29
 */
class App
{
    protected static $app;

    public static function make($class)
    {
        if (!isset(self::$app[$class])){
            self::$app[$class] = new $class;
        }
        return self::$app[$class];
    }
}