<?php
/**
 * 最大堆.
 * User: hwbaker
 * Date: 2018/4/13
 * Time: 10:25
 */

namespace struct;


class IndexMaxHeap
{

    private $count;
    private $data = array();
    private $indexes = array();

    private $reverse = array();

    function __construct()
    {
        $this->count = 0;
    }

    function __destruct()
    {
        unset($this->data);
        unset($this->indexes);

        unset($this->reverse);
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
        echo 'data:' . print_r($this->data, true);
        echo 'indexes:' . print_r($this->indexes, true);
        echo 'reverse:' . print_r($this->reverse, true);
        echo "print End...\r\n\r\n";
    }

    /**
     * 插入元素
     * @param $i    插入索引位置，对于外部传入i的用户而言,是从0开始索引的
     * @param $item 插入数据
     */
    function insert($i, $item)
    {
        $i = $i + 1;
        $this->data[$i] = $item;
        $this->indexes[$this->count + 1] = $i;

        // 维护reverse
        $this->reverse[$i] = $this->count + 1;

        $this->count ++;
        $this->shiftUp($this->count);

    }
    private function shiftUp($k)
    {
        while ($k > 1 && $this->data[$this->indexes[floor($k/2)]] < $this->data[$this->indexes[$k]]) {

            $tmp = $this->indexes[floor($k/2)];
            $this->indexes[floor($k/2)] = $this->indexes[$k];
            $this->indexes[$k] = $tmp;

            // 维护reverse
            $this->reverse[$this->indexes[floor($k/2)]] = floor($k/2);
            $this->reverse[$this->indexes[$k]] = $k;

            $k = floor($k/2);
        }
    }

    /**
     * 从堆中取出元素，只能从根节点取出元素
     */
    function extractMax()
    {
        $ele = $this->data[$this->indexes[1]];

        $tmp = $this->indexes[$this->count];
        $this->indexes[$this->count] = $this->indexes[1];
        $this->indexes[1] = $tmp;

        // 维护reverse
        $this->reverse[$this->indexes[$this->count]] = $this->count;
        $this->reverse[$this->indexes[1]] = 1;

        unset($this->data[$this->indexes[$this->count]]);
        unset($this->indexes[$this->count]);
        unset($this->reverse[$this->count]);

        $this->count--;

        $this->shiftDown(1);

        return $ele;

    }
    private function shiftDown($k)
    {
        while (2 * $k <= $this->count) {
            $lL = 2 * $k;
            if ($lL + 1 <= $this->count && $this->data[$this->indexes[$lL + 1]] > $this->data[$this->indexes[$lL]]) {
                $lL++;
            }

            if ($this->data[$this->indexes[$k]] > $this->data[$this->indexes[$lL]]) {
                break;
            }

            $tmp = $this->indexes[$k];
            $this->indexes[$k] = $this->indexes[$lL];
            $this->indexes[$lL] = $tmp;

            // 维护reverse
            $this->reverse[$this->indexes[$k]] = $k;
            $this->reverse[$this->indexes[$lL]] = $lL;

            $k = $lL;
        }
    }

    /**
     * 根据索引获取数据
     * @param $i
     * @return bool|mixed
     */
    function getItem($i)
    {
        if ($i < 0 || $i > $this->count) {
            return false;
        }
        return $this->data[$i + 1];
    }

    /**
     * 修改堆数据
     * @param $i
     * @param $item
     * @return bool
     */
    function change($i, $item)
    {
        if ($i < 0 || $i > $this->count) {
            return false;
        }

        $i++;
        $this->data[$i] = $item;

        // 找到index[j]=i,j表示data[i]在堆中的位置
//        for ($j = 1; $j < $this->count; $j++) {
//            if ($this->indexes[$j] == $i) {
//                $this->shiftUp($j);
//                $this->shiftDown($j);
//                return true;
//            }
//        }
        $j = $this->reverse[$i];
        $this->shiftUp($j);
        $this->shiftDown($j);
    }

}

$heap = new IndexMaxHeap();
$heap->insert(0, 1);
$heap->insert(1, 22);
$heap->insert(2, 30);
//$heap->insert(3, 2);
//$heap->insert(4, 6);
//$heap->insert(5, 9);
//$heap->insert(6, 70);
$heap->printData();
//$heap->extractMax();
$heap->change(0, 23);
$heap->printData();

