<?php
/**
 * 队列实现-掌握队列的实现原理和机制.
 * User: hwbaker
 * Date: 2018/4/17
 * Time: 12:51
 */

//namespace struct;

class MyQueue
{
    private $mQueue;
    private $mQueueLen; //数组元素个数
    private $mHead; //队头
    private $mTail; //队尾

    const mQueueCapacity = 7; //数组容量

    function __construct()
    {
        $this->mQueue = array();
        $this->mQueueLen = 0;
        $this->mHead = 0;
        $this->mTail = 0;
    }

    function __destruct()
    {
        unset($this->mQueueLen);
    }

    /**
     * 清空队列
     */
    function clearQueue()
    {
        $this->mQueueLen = 0;
        $this->mHead = 0;
        $this->mTail = 0;
    }

    /**
     * 判断队列是否为空
     * @return bool
     */
    function queueEmpty()
    {
        return $this->mQueueLen == 0 ? true : false;
    }

    /**
     * 判断队列是否满
     * @return bool
     */
    function queueFull()
    {
        return $this->mQueueLen == self::mQueueCapacity ? true : false;
    }

    /**
     * 获取队列长度
     */
    function queueLength()
    {
        return $this->mQueueLen;
    }

    /**
     * 元素入队
     * @param $item
     * @return bool
     */
    function enQueue($item)
    {
        if ($this->queueFull()) {
            echo "队列已满...\r\n";
            return false;
        }

        $this->mQueue[$this->mTail] = $item;
        $this->mTail++;
        $this->mTail = $this->mTail % self::mQueueCapacity;
        $this->mQueueLen++;

//        echo 'mQueue:'.print_r($this->mQueue, true);
    }

    /**
     * 元素出队
     * @param $outItem
     * @return bool|mixed
     */
    function deQueue(&$outItem)
    {
        if ($this->queueEmpty()) {
            echo "队列为空...\r\n";
            return false;
        }

        $outItem = $this->mQueue[$this->mHead];
//        unset($this->mQueue[$this->mHead]);
        $this->mHead++;
        $this->mHead = $this->mHead % self::mQueueCapacity;
        $this->mQueueLen--;

        return true;
    }

    /**
     * 遍历
     */
    function queueTraverse()
    {
//        echo 'mHead:'.$this->mHead."\r\n";
//        echo 'mTail:'.$this->mTail."\r\n";
//        echo 'mQueueLen:'.$this->mQueueLen."\r\n";
//        echo 'queueTraverse:'.print_r($this->mQueue, true);
        for ($i = $this->mHead; $i <= $this->mQueueLen; $i++) {
            echo $this->mQueue[$i % self::mQueueCapacity] . ' ';
        }
        echo "\r\n";
    }


}

$out = '';
$queue = new MyQueue();
$queue->enQueue(11);
$queue->deQueue($out);
echo '出队元素:'. $out . "\r\n";
$queue->queueTraverse();

$queue->enQueue(2);
$queue->enQueue(3);
$queue->enQueue(4);
$queue->queueTraverse();