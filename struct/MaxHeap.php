<?php
/**
 * 最大堆.
 * User: hwbaker
 * Date: 2018/4/13
 * Time: 10:25
 */

namespace struct;


class MaxHeap
{

    private $count;
    private $data = array();

    function __construct()
    {
        $this->count = 0;
    }

    function __destruct()
    {
        unset($this->data);
    }

    function size() {
        return $this->count;
    }

    function isEmpty()
    {
        return $this->count == 0;
    }

    function printData()
    {
        echo "print Begin...\r\n";
        print_r($this->data);
//        for($i = 1; $i <= $this->count; $i++) {
//            echo $this->data[$i] . "\r\n";
//        }
        echo "print End...\r\n\r\n";
    }

    /**
     * 插入元素
     * @param $item
     */
    function insert($item)
    {
        $this->data[$this->count + 1] = $item;
        $this->count ++;

        $this->shiftUp($this->count);

    }
    private function shiftUp($k)
    {
        while ($k > 1 && $this->data[floor($k/2)] < $this->data[$k]) {
            $tmp = $this->data[floor($k/2)];
            $this->data[floor($k/2)] = $this->data[$k];
            $this->data[$k] = $tmp;

            $k = floor($k/2);
        }
    }

    /**
     * 从堆中取出元素，只能从根节点取出元素
     */
    function extractMax()
    {
        $ele = $this->data[1];

        // 最后一个节点与根节点交换
        $tmp = $this->data[$this->count];
        $this->data[$this->count] = $this->data[1];
        $this->data[1] = $tmp;

        unset($this->data[$this->count]);
        $this->count--;

        $this->shiftDown(1);

        return $ele;

    }
    private function shiftDown($k)
    {
        while (2 * $k <= $this->count) {
            $lL = 2 * $k;
            if ($lL + 1 <= $this->count && $this->data[$lL + 1] > $this->data[$lL]) {
                $lL++;
            }

            if ($this->data[$k] > $this->data[$lL]) {
                break;
            }

            $tmp = $this->data[$k];
            $this->data[$k] = $this->data[$lL];
            $this->data[$lL] = $tmp;

            $k = $lL;
        }
    }

    /**
     * 最大堆排序
     * @param array $array
     * @return array
     */
    function maxHeapSort1(array $array)
    {
        $n = count($array);
        for ($i = 0; $i < $n ; $i++) {
            $this->insert($array[$i]);
        }

        $arr = array();
        while (!$this->isEmpty()) {
            $arr[] = $this->extractMax();
        }
        return $arr;
    }

    /**
     * 给定一个数组，使数组的排序形成"堆形状".该过程称为"Heapify"
     * @param $array
     */
    function heapify(array $array)
    {
        $n = count($array);
        for ($i = 0; $i < $n ; $i++) {
            $this->data[$i + 1] = $array[$i];
        }
        $this->count = $n;

        for ($i = floor($n/2); $i >= 1; $i--) {
            $this->shiftDown($i);
        }
    }

    /**
     * 应用Heapify进行堆排序
     * @param $array
     * @return array
     */
    function maxHeapSort2(array $array)
    {
        $this->heapify($array);

        $arr = array();
        while (!$this->isEmpty()) {
            $arr[] = $this->extractMax();
        }
        return $arr;
    }

    /**
     * 原地堆排序。优化的堆排序。
     * 注：索引从0开始
     * @param array $array
     */
    function maxHeapSort(array &$array)
    {
        $n = count($array);

        for ($i = floor(($n - 1)/2); $i >= 0; $i--) {
            $this->__shiftDown($array, $n, $i);
        }

        for ($i = $n - 1; $i > 0; $i--) {

            $tmp = $array[$i];
            $array[$i] = $array[0];
            $array[0] = $tmp;
            echo "sta...\r\n";
            $this->__shiftDown($array, $i, 0);
            echo "end...\r\n";
        }
    }

    /**
     * 下沉操作，索引从0开始
     * @param $array
     * @param $n
     * @param $k
     */
    private function __shiftDown(&$array, $n, $k)
    {
        while (2 * $k + 1 < $n) {
            $lL = 2 * $k + 1;
            if ($lL + 1 < $n && $array[$lL + 1] > $array[$lL]) {
                $lL++;
            }

            if ($array[$k] > $array[$lL]) {
                break;
            }

            $tmp = $array[$k];
            $array[$k] = $array[$lL];
            $array[$lL] = $tmp;

            $k = $lL;
        }
    }

}

$heap = new MaxHeap();
//$heap->insert(3);
//$heap->insert(5);
//$heap->insert(8);
//$heap->insert(2);
//$heap->insert(6);
//$heap->insert(9);
//$heap->insert(7);
//$heap->printData();
//$heap->extractMax();
//$heap->printData();

$array = array(3,5,8,2,6,9,7,78);
//$res = $heap->maxHeapSort1($array);
//echo '最大堆排序:' . print_r($res, true) . "\r\n";

$heap->heapify($array);
echo "heapify:";
$heap->printData();

//$res = $heap->maxHeapSort2($array);
//echo 'heapify排序:' . print_r($res, true) . "\r\n";

$heap->maxHeapSort($array);
echo '原地堆排序，优化:' . print_r($array, true) . "\r\n";
