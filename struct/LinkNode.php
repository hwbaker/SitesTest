<?php
/**
 * 链表-节点链表-单链表.
 * User: hwbaker
 * Date: 2018/4/23
 * Time: 10:25
 */

//namespace struct;
include "NodeForLink.php";

class LinkNode
{
    private $mList;
    private $mListLength;

    public function __construct(NodeForLink $node)
    {
        $this->mList = $node;
        $this->mListLength = 0;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->ClearList();
        $this->mList= null;
    }

    /**
     * 清空链表-头结点会保留
     */
    public function ClearList()
    {
        $this->mList->next = null;

//        $currentNode = $this->mList->next;
//        while ($currentNode != null) {
//            $currentNode = $currentNode->next;
//        };
    }

    /**
     * 判断链表是否为空
     */
    public function ListEmpty()
    {
        return 0 == $this->mListLength ? true : false;
    }

    /**
     * 获取链表长度
     */
    public function ListLength()
    {
        return $this->mListLength;
    }

    /**
     * 在i位置查找节点，并返回
     * @param $i
     * @param NodeForLink $pNode
     * @return bool
     */
    public function GetElem($i, NodeForLink &$pNode)
    {
        if ($i < 0 || $i >= $this->mListLength) {
            return false;
        }

        $currentNode = $this->mList;
        for ($k = 0; $k <= $i; $k++) {
            $currentNode = $currentNode->next;
        }

        $pNode->data = $currentNode->data;
//        $pNode->next = $currentNode->next;

        return true;
    }

    /**
     * 给定元素，定位元素的位序
     * @param NodeForLink $pNode
     * @return int
     */
    public function LocateElem(NodeForLink $pNode)
    {
        $currentNode = $this->mList;
        $i = 0;
        while (null != $currentNode->next) {
            $currentNode = $currentNode->next;
            if ($currentNode->data == $pNode->data) {
                return $i;
            }
            $i++;
        }
        return -1;
    }

    /**
     * 前驱
     * @param NodeForLink $pCurrentNode
     * @param NodeForLink $pPreNode
     * @return bool
     */
    public function PriorElem(NodeForLink $pCurrentNode, NodeForLink &$pPreNode)
    {
        $currentNode = $this->mList;
        $tempNode = null;

        while (null != $currentNode->next) {
            $tempNode = $currentNode;
            $currentNode = $currentNode->next;
            if ($currentNode->data == $pCurrentNode->data) {
                if ($tempNode == $this->mList) {
                    return false;
                }
                $pPreNode->data = $tempNode->data;
                return true;
            }
        }

        return false;
    }

    /**
     * 后继
     * @param NodeForLink $pCurrentNode
     * @param NodeForLink $pNextNode
     * @return bool
     */
    public function NextElem(NodeForLink $pCurrentNode, NodeForLink &$pNextNode)
    {
        $currentNode = $this->mList;

        while (null != $currentNode->next) {
            $currentNode = $currentNode->next;
            if ($currentNode->data == $pCurrentNode->data) {
                if ($currentNode->next == null) {
                    return false;
                }
                $pNextNode->data = $currentNode->next->data;
                return true;
            }
        }

        return false;
    }

    /**
     * 遍历
     */
    public function ListTraverse()
    {
        echo '遍历:' . print_r($this->mList, true);
    }

    /**
     * 在链表i位置后面插入节点
     * @param $i
     * @param NodeForLink $node
     * @return bool
     */
    public function ListInsert($i, NodeForLink $node)
    {
        if ($i < 0 || $i > $this->mListLength) {
           return false;
        }

        $currentNode = $this->mList;
        for ($k = 0; $k < $i; $k++) {
            $currentNode = $currentNode->next;
        }

        $newNode = new NodeForLink($node->data, $node->next);
        if (null == $newNode) {
            return false;
        }
        $newNode->next = $currentNode->next;
        $currentNode->next = $newNode;

        $this->mListLength++;
        return true;
    }

    /**
     * 链表i位置后的节点删除
     * @param $i
     * @param NodeForLink $pNode
     * @return bool
     */
    public function ListDelete($i, NodeForLink &$pNode)
    {
        if ($i < 0 || $i >= $this->mListLength) {
            return false;
        }

        $currentNode = $this->mList;
        $currentNodeBefore = null;
        for ($k = 0; $k <= $i; $k++) {
            $currentNodeBefore = $currentNode;
            $currentNode = $currentNode->next;
        }

        $currentNodeBefore->next = $currentNode->next;

        $pNode->data = $currentNode->data;
        $pNode->next = $currentNode->next;
        $currentNode = null;

        $this->mListLength--;
        return true;
    }

    /**
     * 从链表头部插入
     * @param NodeForLink $node
     * @return bool
     */
    public function ListInsertHead(NodeForLink $node)
    {
        $currentNode = $this->mList;
        $newNode = new NodeForLink($node->data, $node->next);
        if (null == $newNode) {
            return false;
        }

        $newNode->next = $currentNode->next;
        $currentNode->next = $newNode;

        $this->mListLength++;
        return true;

        /*
        // 方式二
        $tmpNode = $this->mList->next;
        $newNode = new NodeForLink($node->data, $node->next);
        if (null == $newNode) {
            return false;
        }

        $this->mList->next = $newNode;
        $newNode->next = $tmpNode;

        $this->mListLength++;
        return true;
        */
    }

    /**
     * 从链表尾部插入
     * @param NodeForLink $node
     * @return bool
     */
    public function ListInsertTail(NodeForLink $node)
    {
        $currentNode = $this->mList;
        while (null != $currentNode->next) {
            $currentNode = $currentNode->next;
        }

        $newNode = new NodeForLink($node->data, $node->next);
        if (null == $newNode) {
            return false;
        }
        $newNode->next = null;
        $currentNode->next = $newNode;

        $this->mListLength++;
        return true;
    }

}

$linkNode = new LinkNode(new NodeForLink(0, null));
$node1 = new NodeForLink(1, null);
$linkNode->ListInsertHead($node1);
$node2 = new NodeForLink(2, null);
$linkNode->ListInsertHead($node2);
$node3 = new NodeForLink(3, null);
$linkNode->ListInsertHead($node3);

//$linkNode->ListInsertHead($node3);

//$node1 = new NodeForLink(1, null);
//$linkNode->ListInsert(0, $node1);
//$node2 = new NodeForLink(2, null);
//$linkNode->ListInsert(0, $node2);
//$node3 = new NodeForLink(3, null);
//$linkNode->ListInsert(2, $node3);
$linkNode->ListTraverse();
//$linkNode->ClearList();
//$linkNode->ListTraverse();

//$deleteNode = new NodeForLink(0, null);
//$linkNode->ListDelete(0, $deleteNode);
//echo "\r\n....删除节点:";
//print_r($deleteNode);
//$linkNode->ListTraverse();

$i = 3;
$searchNode = new NodeForLink(0, null);
$linkNode->GetElem($i, $searchNode);
echo "\r\n....查找节点->{$i}:";
print_r($searchNode);