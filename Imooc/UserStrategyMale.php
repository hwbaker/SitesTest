<?php
/**
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/3/27
 * Time: 17:14
 */

namespace Imooc;


class UserStrategyMale implements UserStrategy
{
    function showAd() {
        echo "2018汽车<br>";
    }

    function showCate() {
        echo "电子<br>";
    }

}