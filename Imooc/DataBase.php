<?php
/**
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/3/27
 * Time: 14:18
 */

namespace Imooc;


class DataBase
{
    protected static $db;
    private function __construct()
    {
    }

    static function getInstance()
    {
        if (self::$db) {
            echo "had new...<br>";
            return self::$db;
        } else {
            echo "new...<br>";
            self::$db = new self();
            return self::$db;
        }

    }

    function where($where) {
        return $this;
    }

    function order($order) {
        return $this;
    }

    function limit($limit) {
        return $this;
    }
}