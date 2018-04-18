<?php
/**
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/3/27
 * Time: 11:38
 */
namespace Imooc;

class Loder
{
    static function autoload($class)
    {
        $file = BASEDIR.'/'.str_replace('\\', '/', $class).'.php';
        require $file;
    }
}