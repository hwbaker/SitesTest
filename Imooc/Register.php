<?php
/**
 * 注册树模式
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/3/27
 * Time: 15:33
 */

namespace Imooc;


class Register
{
    protected static $objects;

    static function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    static function get($alias)
    {
        return self::$objects[$alias];
    }

    function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}