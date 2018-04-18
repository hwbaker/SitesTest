<?php
/**
 * Created by PhpStorm.
 * 策略模式
 * User: hwbaker
 * Date: 2018/3/27
 * Time: 17:11
 */

namespace Imooc;


interface UserStrategy
{
    function showAd();
    function showCate();

}