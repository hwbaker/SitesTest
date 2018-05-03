<?php
/**
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/4/23
 * Time: 10:33
 */

//namespace struct;


class NodeForLink
{
    public $next; //指针域
    public $data; //数据域

    function __construct($data = 0, NodeForLink $next = null)
    {
        $this->data = $data;
        $this->next = null;
    }

    public function printNode()
    {
        print_r($this);
    }
}