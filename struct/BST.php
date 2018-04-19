<?php
/**
 * 二分搜索树
 * Class BSR:Binary Search Tree
 * User: hwbaker
 * Date: 2018/4/8
 * Time: 11:14
 */

include "autoLoad.php";

class BST
{
    private $root;

    function __construct(Node $node)
    {
        $this->root = $node;
    }


    function __destruct()
    {
        // 释放空间,销毁对象
        $this->destroy($this->root);
    }

    /**
     * @desc 打印树
     */
    public function printNode()
    {
        print_r($this->root);
    }

    /**
     * @desc 插入节点
     * @param Node $pNode
     */
    public function insert(Node $pNode)
    {
        $this->root = $this->insertPrivate($this->root, $pNode);
    }

    /**
     * @desc 向以node为根的二叉搜索树中,插入节点
     * 返回插入新节点后的二叉搜索树的根
     * @param Node $root
     * @param Node $pNode
     * @return Node
     */
    private function insertPrivate(Node $root, Node $pNode)
    {
        $indexInsert = $pNode->index;
        $dataInsert = $pNode->data;

        if ($indexInsert == $root->index ) {
            $root->data = $dataInsert;
        } else if ($indexInsert < $root->index) {
            // index < node->index,左子节点
            if ($root->pLChild == null) {
                $root->pLChild = $pNode;
            } else {
                $root->pLChild = $this->insertPrivate($root->pLChild, $pNode);
            }
        } else {
            // index > node->index,右子节点
            if ($root->pRChild == null) {
                $root->pRChild = $pNode;
            } else {
                $root->pRChild = $this->insertPrivate($root->pRChild, $pNode);
            }
        }
        return $root;
    }

    /**
     * @desc 查找二分搜索树中是否存在某个key值
     * @param $index
     * @return bool
     */
    public function contain($index)
    {
        return $this->root->BSTContain($index);
    }

    /**
     * @desc  查找key所对应的val
     * @param $index
     * @return null
     */
    public function search($index)
    {
        return $this->root->BSTSearchNode($index);
    }

    /**
     * 前序遍历
     */
    public function preOrder()
    {
        echo "\r\n\r\n前序遍历.... \r\n" ;
        $this->root->preOrderTraversal();
    }

    /**
     * 中序遍历
     */
    public function inOrder()
    {
        echo "\r\n\r\n中序遍历.... \r\n" ;
        $this->root->inOrderTraversal();
    }

    /**
     * 后序遍历
     */
    public function postOrder()
    {
        echo "\r\n\r\n后续遍历.... \r\n" ;
        $this->root->postOrderTraversal();
    }

    /**
     * @param $node
     */
    private function destroy($node)
    {
        if ($node != null) {
            $this->destroy($node->pLChild);
            $this->destroy($node->pRChild);

            //释放node todo...
            unset($node);
        }
    }

}

$root = new Node(28, 28);
$bst = new BST($root);

$node1 = new Node(16, 16, null, null, null);
$bst->insert($node1);
$node2 = new Node(30, 30, null, null, null);
$bst->insert($node2);
$node3 = new Node(13, 13, null, null, null);
$bst->insert($node3);
$node4 = new Node(22, 22, null, null, null);
$bst->insert($node4);

$bst->printNode();

echo "索引是否存在\r\n";
var_dump($bst->contain(22));

echo "根据索引查找节点\r\n";
var_dump($bst->search(22));

$bst->preOrder();
$bst->inOrder();
$bst->postOrder();