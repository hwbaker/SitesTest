<?php
/**
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/4/8
 * Time: 11:14
 */


/**
 * Class BSR:Binary Search Tree
 */
class BST
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
            $root = new Node($key, $value);
            return $root;
        }

        if ($key == $node->index ) {
            $node->data = $value;
        } else if ($key < $node->index) { // key < node->key,左子节点
            $node->pLChild = $this->insertPrivate( $node->pLChild , $key, $value);
        } else { // key > node->key,右子节点
            $node->pRChild = $this->insertPrivate( $node->pRChild, $key, $value);
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

        if ($key == $node->index) {
            return true;
        } else if ($key < $node->index) {
            return $this->containPrivate($node->pLChild, $key);
        } else {
            return $this->containPrivate($node->pRChild, $key);
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

        if ($key == $node->index) {
            return $node->data;
        } else if ($key < $node->index) {
            return $this->searchPrivate($node->pLChild, $key);
        } else {// key > node->key
            return $this->searchPrivate($node->pRChild, $key);
        }
    }

    /**
     * @desc 对以node为节点的二叉搜索树进行前序遍历
     * @param $node
     */
    private function preOrderPrivate($node)
    {
        if ($node != null) {
            var_dump($node->index);
            $this->preOrderPrivate($node->pLChild);
            $this->preOrderPrivate($node->pRChild);
        }
    }

    /**
     * @desc 对以node为节点的二叉搜索树进行中序遍历
     * @param $node
     */
    private function inOrderPrivate($node)
    {
        if ($node != null) {
            $this->inOrderPrivate($node->pLChild);
            var_dump($node->index);
            $this->inOrderPrivate($node->pRChild);
        }
    }

    /**
     * @desc 对以node为节点的二叉搜索树进行后序遍历
     * @param $node
     */
    private function postOrderPrivate($node)
    {
        if ($node != null) {
            $this->postOrderPrivate($node->pLChild);
            $this->postOrderPrivate($node->pRChild);
            var_dump($node->index);
        }
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