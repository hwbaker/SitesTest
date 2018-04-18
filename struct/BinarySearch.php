<?php
/**
 * 二分法查找
 * User: hwbaker
 * Date: 2018/4/17
 * Time: 10:37
 */

namespace struct;


class BinarySearch
{

    /**
     * 非递归 有序数组 二分法查找
     * @param array $arr
     * @param $target
     * @return float|int
     */
    function binarySearch(array $arr, $target)
    {
        $n = count($arr);
        $l = 0;
        $r = $n - 1;

        while ($l <= $r) {
            $mid = $l + floor(($r - $l)/2);
            if ($target == $arr[$mid]) {
                return $mid;
            }

            if ($target < $arr[$mid]) {
                $r = $mid - 1;
            } else {
                $l = $mid + 1;
            }
        }

        return -1;
    }

    /**
     * 递归 有序数组 二分法查找
     * @param array $arr
     * @param $target
     * @return float|int
     */
    function binarySearch2(array $arr, $target)
    {
        $n = count($arr);
        return self::__binarySearch2($arr, 0, $n - 1, $target);
    }

    public static function __binarySearch2(array $arr, $l, $r, $target)
    {
        if ($l > $r) {
            return -1;
        }

        $mid = $l + floor(($r - $l)/2);
        if ($target == $arr[$mid]) {
            return $mid;
        } else if ($target < $arr[$mid]) {
            return self::__binarySearch2($arr, 0, $mid - 1, $target);
        } else {
            return self::__binarySearch2($arr, $mid + 1, $r, $target);
        }
    }

}

$array = array(1, 2, 3, 4, 30, 31, 34);
$target = 4;

$binarySearch = new BinarySearch();
echo 'array:' . print_r($array, true). "\r\n";
echo 'target:' . $target . "\r\n";
$mid = $binarySearch->binarySearch($array, $target);
echo 'mid:' . $mid . "\r\n";

$mid = $binarySearch->binarySearch2($array, $target);
echo '递归查找mid:' . $mid . "\r\n";