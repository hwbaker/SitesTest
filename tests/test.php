<?php
/**
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/3/27
 * Time: 10:26
 */

//require 'test1.php';
//require 'test2.php';

function myLoad($class = ''){
//    var_dump(__DIR__);
//    var_dump($class);
    $classPath = __DIR__.'/../'.str_replace('\\', '/', $class).'.php';
    if(file_exists($classPath)){
        require $classPath;
    }else{
        echo $classPath." not be found!";
    }
}
spl_autoload_register("myLoad");
tests\test1::test();
echo "<hr>";
tests\test2::test();



