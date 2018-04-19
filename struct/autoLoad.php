<?php

/**
 * 自动加载类
 * @param string $class
 */
function myLoad($class = ''){
//    var_dump(__DIR__);
//    var_dump($class);
    $classPath = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classPath)) {
        require $classPath;
    } else {
        echo $classPath . ' not be found!';
    }
}

spl_autoload_register("myLoad");