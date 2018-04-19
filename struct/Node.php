<?php
/**
 * @desc 二分搜索树
 * Created by PhpStorm.
 * User: hwbaker
 * Date: 2018/4/8
 * Time: 11:07
 *
 * cd /Users/hwbaker/Sites/test/struct
 * /usr/bin/php TreeLink.php
 */

//namespace struct;

class Node
{
    public $index;
    public $data;
    public $pLChild;
    public $pRChild;
    public $pParent;

    public function __construct($index, $data, Node $lChild = null, Node $rChild = null, Node $parentNode = null)
    {
        $this->index = $index;
        $this->data = $data;
        $this->pLChild = $lChild;
        $this->pRChild = $rChild;
        $this->pParent = $parentNode;
    }

    /**
     * 搜索节点
     * @param $nodeIndex
     * @return $this|Node|null
     */
    function searchNode($nodeIndex)
    {
        if ($this->index == $nodeIndex) {
            return $this;
        }

        // 查找左结点
        if($this->pLChild != null){
            if ($this->pLChild->index == $nodeIndex) {
                return $this->pLChild;
            } else {
                $tempNode = $this->pLChild->SearchNode($nodeIndex);
                if($tempNode != null){
                    return $tempNode;
                }
            }
        }

        // 查找右结点
        if ($this->pRChild != null) {
            if ($this->pRChild->index == $nodeIndex) {
                return $this->pRChild;
            } else {
                $tempNode = $this->pRChild->SearchNode($nodeIndex);
                if($tempNode != null){
                    return $tempNode;
                }
            }
        }

        return null;

    }

    function deleteNode()
    {
        // 左右结点
        if ($this->pLChild != null) {
            $this->pLChild->deleteNode();
        }

        if ($this->pRChild != null) {
            $this->pRChild->deleteNode();
        }

        // 父结点
        if ($this->pParent != null) {
            if ($this->pParent->pLChild == $this) {
                $this->pParent->pLChild = null;
            }
            if ($this->pParent->pRChild == $this) {
                $this->pParent->pRChild = null;
            }
        }

        // 自杀
//        unset($this);
    }

    /**
     * 前序遍历(深度优先遍历)
     * 跟-》左-》右
     */
    function preOrderTraversal()
    {
        echo $this->data . '(' . $this->index . ")\r\n";

        if ($this->pLChild != null) {
            $this->pLChild->preOrderTraversal();
        }
        if ($this->pRChild != null) {
            $this->pRChild->preOrderTraversal();
        }
    }

    /**
     * 中序遍历(深度优先遍历)
     * 左-》根-》右
     */
    function inOrderTraversal()
    {
        if ($this->pLChild != null) {
            $this->pLChild->inOrderTraversal();
        }

        echo $this->data . '(' . $this->index . ")\r\n";

        if ($this->pRChild != null) {
            $this->pRChild->inOrderTraversal();
        }
    }

    /**
     * 后序遍历(深度优先遍历)
     * 左-》右-》根
     */
    function postOrderTraversal()
    {
        if ($this->pLChild != null) {
            $this->pLChild->postOrderTraversal();
        }
        if ($this->pRChild != null) {
            $this->pRChild->postOrderTraversal();
        }

        echo $this->data . '(' . $this->index . ")\r\n";
    }

    /**
     * 层序遍历(广度优先遍历)
     * @param MyQueue $queue
     */
    function levelTraversal(MyQueue $queue)
    {
        $queue->enQueue($this);
        $deOutNode = '';
        while (!$queue->queueEmpty()) {
            $queue->deQueue($deOutNode);
            echo $deOutNode->data . '(' . $deOutNode->index . ")\r\n";

            if ($deOutNode->pLChild != null) {
                $queue->enQueue($deOutNode->pLChild);
            }
            if ($deOutNode->pRChild != null) {
                $queue->enQueue($deOutNode->pRChild);
            }
        }
    }

    /**
     * 查找二分搜索树中是否存在某个index
     * @param $nodeIndex
     * @return bool
     */
    function BSTContain($nodeIndex)
    {
        if ($nodeIndex == $this->index) {
            return true;
        }

        if ($nodeIndex < $this->index) {
            if ($this->pLChild != null) {
                return $this->pLChild->BSTContain($nodeIndex);
            } else {
                return false;
            }
        } else {
            if ($this->pRChild != null) {
                return $this->pRChild->BSTContain($nodeIndex);
            } else {
                return false;
            }
        }
    }

    /**
     * 二分搜索树查找
     * @param $nodeIndex
     * @return $this|Node
     */
    function BSTSearchNode($nodeIndex)
    {
        if ($nodeIndex == $this->index) {
            return $this;
        }

        if ($nodeIndex < $this->index) {
            if ($this->pLChild != null) {
                if ($nodeIndex == $this->pLChild->index) {
                    return $this->pLChild;
                } else {
                    $tmpNode = $this->pLChild->BSTSearchNode($nodeIndex);
                    return $tmpNode;
                }
            } else {
                return null;
            }
        } else {
            if ($this->pRChild != null) {
                if ($nodeIndex == $this->pRChild->index) {
                    return $this->pRChild;
                } else {
                    $tmpNode = $this->pRChild->BSTSearchNode($nodeIndex);
                    return $tmpNode;
                }
            } else {
                return null;
            }
        }
    }

}