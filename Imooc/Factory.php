<?php
/**
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/3/27
 * Time: 14:15
 */

namespace Imooc;


class Factory
{
    static function createDatabase()
    {
//        $db = new DataBase();
        $db = DataBase::getInstance();
        Register::set('db1', $db);
        return $db;
    }
}