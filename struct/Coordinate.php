<?php
/**
 * 定义坐标类.栈的丰富使用示例.
 * User: hwbaker
 * Date: 2018/4/19
 * Time: 16:08
 */

//namespace struct;


class Coordinate
{
    private $mX;
    private $mY;

    function __construct($x = 0, $y = 0)
    {
        $this->mX = $x;
        $this->mY = $y;
    }

    function __destruct()
    {
        unset($this->mX);
        unset($this->mY);
        // TODO: Implement __destruct() method.
    }

    function printCoordinate()
    {
        echo '(' . $this->mX . ',' . $this->mY . ")\r\n";
    }
}