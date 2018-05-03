<?php
/**
 * 栈实现-掌握栈的实现原理和机制.
 * User: hwbaker
 * Date: 2018/4/19
 * Time: 14:14
 */

//namespace struct;
include "autoLoad.php";

class MyStack
{
    private $mStack;
    private $mTop; //栈顶，栈元素个数
    private $mCapacity; //栈容量

    function __construct($capacity = 0)
    {
        $this->mStack = array();
        $this->mTop = 0;
        $this->mCapacity = $capacity;
    }

    function __destruct()
    {
        unset($this->mStack);
    }

    /**
     * 判栈空
     */
    function stackEmpty()
    {
        return 0 == $this->mTop ? true : false;
    }

    /**
     * 判栈满
     */
    function stackFull()
    {
        return $this->mTop == $this->mCapacity ? true : false;
    }

    /**
     * 返回栈所有元素
     */
    function stackLength()
    {
        return $this->mTop;
    }

    /**
     * 清空栈
     */
    function clearStack()
    {
        $this->mTop = 0;
    }

    /**
     * 元素入栈，栈顶上升
     * @param $item
     * @return bool
     */
    function push($item)
    {
        if ($this->stackFull()) {
            echo "栈已满...\r\n";
            return false;
        }

        $this->mStack[$this->mTop] = $item;
        $this->mTop++;
        return true;
    }

    /**
     * 栈顶元素出站，栈顶下降
     * @param $item
     * @return bool|mixed
     */
    function pop(&$item)
    {
        if ($this->stackEmpty()) {
            echo "栈为空...\r\n";
            return false;
        }

        $item = $this->mStack[--$this->mTop];
        return true;
    }

    /**
     * 遍历栈中所有元素
     * @param bool $isFromBottom
     */
    function stackTraverse($isFromBottom = false)
    {
        echo "遍历:\r\n";
        if ($isFromBottom) {
            for ($i = 0; $i < $this->stackLength(); $i++) {
                echo $this->mStack[$i] . " ";
//                $this->mStack[$i]->printCoordinate();
            }
        } else {
            for ($i = $this->stackLength() - 1; $i >=0 ; $i--) {
                echo $this->mStack[$i] . " ";
//                $this->mStack[$i]->printCoordinate();
            }
        }
        echo "\r\n";
    }

}

//$stack = new MyStack(4);
//$stack->push(1);
//$stack->push('o');
//$stack->push('r');
//$stack->push(4);
//$stack->push(5);
//
//$pop = '';
//$stack->pop($pop);
//echo '出栈元素:' . $pop . "\r\n";
//
//$stack->stackTraverse();
//
//$stack->clearStack();
//if ($stack->stackEmpty()) {
//    echo "栈为空...\r\n";
//}

//$stack->push(new Coordinate(1,1));
//$stack->push(new Coordinate(2,2));
//$stack->stackTraverse();