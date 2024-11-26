<?php
namespace Jizhi\Admin\utils;

class Hash
{
    public static $_instance = null;

    public static function instance()
    {
        if (!static::$_instance) {
            static::$_instance = new \Jizhi\Admin\utils\hashing\Hash();
        }
        return static::$_instance;
    }


    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return static::instance()->{$name}(...$arguments);
    }
}
