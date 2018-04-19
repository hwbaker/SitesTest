<?php

/**
 * @desc 二分搜索树
 * Created by PhpStorm.
 * User: hewei
 * Date: 17/6/4
 * Time: 下午4:29
 * cd /users/hewei/site/git/algorithms
 * /usr/local/bin/php binarySearchTree.php
 */
class Node
{
    public $key = null;
    public $value = null;
    public $left = null;
    public $right = null;
}

/**
 * Class BSR:Binary Search Tree
 */
class BST1
{
    private $root;

    function __construct()
    {
        $this->root = null;
    }


    function __destruct()
    {
        // TODO: Implement __destruct() method.
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
     * @desc 插入元素
     * @param $key
     * @param $value
     */
    public function insert($key, $value)
    {
        $this->root = $this->insertPrivate($this->root, $key, $value);
    }

    /**
     * @desc  查找二分搜索树中是否存在某个key值
     * @param $key
     * @return bool
     */
    public function contain($key)
    {
        return $this->containPrivate($this->root, $key);
    }

    /**
     * @desc  查找key所对应的val
     * @param $key
     * @return null
     */
    public function search($key)
    {
        return $this->searchPrivate($this->root, $key);
    }

    /**
     * 前序遍历
     */
    public function preOrder()
    {
        $this->preOrderPrivate($this->root);
    }

    /**
     * 中序遍历
     */
    public function inOrder()
    {
        $this->inOrderPrivate($this->root);
    }

    /**
     * 后序遍历
     */
    public function postOrder()
    {
        $this->postOrderPrivate($this->root);
    }

    /**
     * @desc 向以node为根的二叉搜索树中,插入节点(key, val)
     * 返回插入新节点后的二叉搜索树的根
     * @param $node
     * @param $key
     * @param $value
     * @return Node
     */
    private function insertPrivate($node, $key, $value)
    {
        // 根节点 空
        if ($node == null) {
            $root = new Node();
            $root->key = $key;
            $root->value = $value;
            return $root;
        }

        if ($key == $node->key ) {
            $node->value = $value;
        } else if ($key < $node->key ) { // key < node->key,左子节点
            $node->left = $this->insertPrivate( $node->left , $key, $value);
        } else { // key > node->key,右子节点
            $node->right = $this->insertPrivate( $node->right, $key, $value);
        }
        return $node;
    }

    /**
     * @param $node
     * @param $key
     * @return bool
     */
    private function containPrivate($node, $key)
    {
        if ($node == null) {
            return false;
        }

        if ($key == $node->key) {
            return true;
        } else if ($key < $node->key) {
            return $this->containPrivate($node->left, $key);
        } else {
            return $this->containPrivate($node->right, $key);
        }
    }

    /**
     * @desc  在以node为根的二叉搜索树中查找key所对应的value
     * @param $node
     * @param $key
     * @return null
     */
    private function searchPrivate($node, $key)
    {
        if ($node == null) {
            return null;
        }

        if ($key == $node->key) {
            return $node->value;
        } else if ($key < $node->key) {
            return $this->searchPrivate($node->left, $key);
        } else {// key > node->key
            return $this->searchPrivate($node->right, $key);
        }
    }

    /**
     * @desc 对以node为节点的二叉搜索树进行前序遍历
     * @param $node
     */
    private function preOrderPrivate($node)
    {
        if ($node != null) {
            var_dump($node->key);
            $this->preOrderPrivate($node->left);
            $this->preOrderPrivate($node->right);
        }
    }

    /**
     * @desc 对以node为节点的二叉搜索树进行中序遍历
     * @param $node
     */
    private function inOrderPrivate($node)
    {
        if ($node != null) {
            $this->inOrderPrivate($node->left);
            var_dump($node->key);
            $this->inOrderPrivate($node->right);
        }
    }

    /**
     * @desc 对以node为节点的二叉搜索树进行后序遍历
     * @param $node
     */
    private function postOrderPrivate($node)
    {
        if ($node != null) {
            $this->postOrderPrivate($node->left);
            $this->postOrderPrivate($node->right);
            var_dump($node->key);
        }
    }

    /**
     * @param $node
     */
    private function destroy($node)
    {
        if ($node != null) {
            $this->destroy($node->left);
            $this->destroy($node->right);

            //释放node todo...
            unset($node);
        }
    }

}

$BST = new BST1();
$BST->insert(28,'28');
$BST->insert(16,'16');
$BST->insert(30,'30');
$BST->insert(13,'13');
$BST->insert(13,'22');
$BST->printNode();
