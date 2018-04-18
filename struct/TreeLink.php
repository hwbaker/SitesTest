<?php
/**
 * @desc 二叉树：链表实现.
 * User: hwbaker
 * Date: 2018/4/8
 * Time: 17:34
 * /usr/bin/php struct/TreeLink.php
 *
 *         3(0)
 *   5(1)         8(2)
 *2(3)  6(4)   9(5)  7(6)
 *
 * 前序：0134256
 * 中序：3140526
 * 后序：3415620
 */

//namespace struct;
include "Node.php";
require_once ("MyQueue.php");

class TreeLink
{

    private $pRoot;

    /**
     * 初始化节点
     * TreeLink constructor.
     * @param Node $node
     */
    function __construct(Node $node)
    {
        $this->pRoot = $node;
    }

    function __destruct()
    {
//        $this->deleteNode(0, null); or
        $this->pRoot->deleteNode(0, null);
    }

    /**
     * 添加节点
     * @param $nodeIndex
     * @param $direction 0 左结点; 1 右结点
     * @param Node $pNode 新增结点
     * @return bool
     */
    function addNode($nodeIndex, $direction, Node $pNode)
    {
        $temp = $this->searchNode($nodeIndex);
        if ($temp == null) {
            return false;
        }

        //指定其父节点为 $temp
        $node = new Node($pNode->index, $pNode->data, null, null, $temp);

        if ($direction == 0) {
            $temp->pLChild = $node;
        } else {
            $temp->pRChild = $node;
        }

        return true;
    }

    /**
     * 删除节点
     * @param $nodeIndex
     * @return bool|Node|null|TreeLink
     */
    function deleteNode($nodeIndex)
    {
        echo "\r\n\r\nDELETE TEST BEGIN.... \r\n" ;
        $temp = $this->searchNode($nodeIndex);
//        echo 'searchDeleteNode:' . print_r($temp, true) ."\r\n";
        if ($temp == null) {
            return false;
        }

        $temp->deleteNode();
        return $temp;
    }

    /**
     * 寻找结点
     * @param $nodeIndex
     * @return $this|Node|null
     */
    function searchNode($nodeIndex)
    {
        return $this->pRoot->searchNode($nodeIndex);
    }

    /**
     * 前序遍历(深度优先遍历)
     * 根->左->右:0134256
     */
    function preOrderTraversal()
    {
        echo "\r\n\r\n前序遍历.... \r\n" ;
        $this->pRoot->preOrderTraversal();
    }

    /**
     * 中序遍历(深度优先遍历)
     * 左-根-右:3140526
     */
    function inOrderTraversal()
    {
        echo "\r\n\r\n中序遍历.... \r\n" ;
        $this->pRoot->inOrderTraversal();
    }

    /**
     * 后序遍历(深度优先遍历)
     * 左-右-根:3415620
     */
    function postOrderTraversal()
    {
        echo "\r\n\r\n后序遍历.... \r\n" ;
        $this->pRoot->postOrderTraversal();
    }

    /**
     * 层序遍历(广度优先遍历)
     */
    function levelTraversal()
    {
        echo "\r\n\r\n层序遍历.... \r\n" ;

//        $queue = new splqueue();
//        $queue->enqueue($this->pRoot);
//        while (!$queue->isEmpty()) {
//            $node = $queue->dequeue();
//            $out = $node->data;
//            echo 'out:'.$out . "\r\n";
//
//            if ($node->pLChild != null) {
//                $queue->enqueue($node->pLChild);
//            }
//            if ($node->pRChild != null) {
//                $queue->enqueue($node->pRChild);
//            }
//        }
//        exit;

        $this->pRoot->levelTraversal(new MyQueue());

    }

}

$nodeRoot = new Node(0, 3);
$treeLink = new TreeLink($nodeRoot);

$node1 = new Node(1, 5, null, null, $nodeRoot);
$treeLink->addNode(0, 0, $node1);
$node2 = new Node(2, 8, null, null, $nodeRoot);
$treeLink->addNode(0, 1, $node2);

$node3 = new Node(3, 2, null, null, $node1);
$treeLink->addNode(1, 0, $node3);
$node4 = new Node(4, 6 , null, null, $node1);
$treeLink->addNode(1, 1, $node4);

$node5 = new Node(5, 9, null, null, $node2);
$treeLink->addNode(2, 0, $node5);
$node6 = new Node(6, 7, null, null, $node2);
$treeLink->addNode(2, 1, $node6);

//$node7 = new Node(7, 4, null, null, $node3);
//$treeLink->addNode(3, 0, $node7);


$treeLink->preOrderTraversal();
$treeLink->inOrderTraversal();
$treeLink->postOrderTraversal();


//$deleteNode = $treeLink->deleteNode(1);
//echo 'DELETE TEST END:' . print_r($deleteNode, true);

//$treeLink->preOrderTraversal();

$treeLink->levelTraversal();
