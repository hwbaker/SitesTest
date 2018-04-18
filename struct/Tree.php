<?php
/**
 * @desc 二叉树-数组表示
 * User: hwbaker
 * Date: 2018/4/8
 * Time: 11:08
 * /usr/bin/php struct/Tree.php
 */
namespace struct;


class Tree
{
    private $m_iSize = 0;
    private $m_pTree = array();

    function __construct($size, $root)
    {
        $this->m_pTree[0] = $root;

        $this->m_iSize = $size;
        for ($i = 1; $i < $size; $i++) {
            $this->m_pTree[$i] = 0;
        }
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        unset($this->m_pTree);
    }

    // 根据索引寻找节点
    function searchNode($nodeIndex)
    {
        if ($nodeIndex < 0 || $nodeIndex > $this->m_iSize) {
            return false;
        }

        if ($this->m_pTree[$nodeIndex] == 0) {
            return false;
        }
        return $this->m_pTree[$nodeIndex];
    }

    /**
     * 添加节点
     * @param $nodeIndex
     * @param $direction 0:左孩子 1:右孩子
     * @param $node
     * @return bool
     */
    function addNode($nodeIndex, $direction, &$node)
    {
        if ($nodeIndex < 0 || $nodeIndex >= $this->m_iSize) {
            return false;
        }

        if ($this->m_pTree[$nodeIndex] == 0) {
            return false;
        }


        //左节点
        $lChild = $nodeIndex * 2 + 1;
        //右节点
        $rChild = $nodeIndex * 2 + 2;


        if ($direction == 0) {
            if ($lChild < 0 || $lChild >= $this->m_iSize) {
                return false;
            }
            //已有左节点，不能添加
            if ($this->m_pTree[$lChild] != 0) {
                return false;
            }

            $this->m_pTree[$lChild] = $node;

        } else {
            if ($rChild < 0 || $rChild >= $this->m_iSize) {
                return false;
            }
            if ($this->m_pTree[$rChild] != 0) {
                return false;
            }


            $this->m_pTree[$rChild] = $node;
        }

        return true;

    }

    /**
     * 删除节点
     * @param $nodeIndex
     * @param $pNode
     * @return bool
     */
    function deleteNode($nodeIndex, &$pNode)
    {
        if ($nodeIndex < 0 || $nodeIndex >= $this->m_iSize) {
            return false;
        }

        if ($this->m_pTree[$nodeIndex] == 0) {
            return false;
        }

        $pNode = $this->m_pTree[$nodeIndex];
        // 节点设置为0视为删除
        $this->m_pTree[$nodeIndex] = 0;

        return true;

    }

    // 遍历
    function treeTraverse()
    {
        for ($i= 0; $i < $this->m_iSize; $i++) {
            echo $this->m_pTree[$i] . "\r\n";
        }
    }

}

$root = 3;
$tree = new Tree(7, $root);

$node1 = 5;
$node2 = 8;
$tree->addNode(0,0, $node1);
$tree->addNode(0,1, $node2);

$node3 = 2;
$node4 = 6;
$node5 = 9;
$node6 = 7;
$tree->addNode(1,0, $node3);
$tree->addNode(1,1, $node4);
$tree->addNode(2,0, $node5);
$tree->addNode(2,1, $node6);

$tree->treeTraverse();

$search = $tree->searchNode(2);
echo 'search:' . $search . "\r\n";

$delete = 0;
$tree->deleteNode(6, $delete);
echo 'delete:' . $delete . "\r\n";

$tree->treeTraverse();