<?php
/**
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/3/27
 * Time: 17:42
 */

namespace Imooc;


abstract class EventGenerator
{
    private $observers;

    function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}