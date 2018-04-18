<?php
/**
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/3/27
 * Time: 17:13
 */

namespace Imooc;


class UserStrategyFemale implements UserStrategy
{
    function showAd() {
        echo "2018美妆<br>";
    }

    function showCate() {
        echo "服装<br>";
    }

}