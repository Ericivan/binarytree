<?php

/**
     * Created by PhpStorm.
     * User: zhongzhiliang
     * Date: 2018/3/27
     * Time: 上午11:13
     */
        class BinaryTree
        {
            public $root = null;

            function __construct()
            {
                $this->root = new TreeNode(1, 'A');
            }

            public function createBinaryTree(TreeNode $root)
            {
                $newNodeB = new TreeNode(2, 'B');
                $newNodeC = new TreeNode(3, 'C');
                $newNodeD = new TreeNode(4, 'D');
                $newNodeE = new TreeNode(5, 'E');
                $newNodeF = new TreeNode(6, 'F');
//                $newNodeG = new TreeNode(7, 'G');

                $root->leftChild = $newNodeB;
                $root->rightChild = $newNodeC;
                $root->leftChild->leftChild = $newNodeD;
                $root->leftChild->rightChild = $newNodeE;
                $root->rightChild->rightChild = $newNodeF;
//                $root->rightChild->leftChild = $newNodeG;
            }

            public function isEmpty()
            {
                return $this->root == null;
            }

            /** 返回树高度 */
            public function getHeight()
            {
                return $this->height($this->root);
            }

            /** 返回节点个数 */
            public function getSize()
            {
                return $this->size($this->root);
            }


            /**
             * @param TreeNode $element
             * @return bool|null|TreeNode
             * @author :Ericivan
             * @name : getParent
             * @description 获取双亲节点
             */
            public function getParent($element)
            {
                return ($this->root == null || $this->root === $element) ? null : $this->parent($this->root, $element);
            }


            /**
             * @param TreeNode $subTree
             * @return int
             * @author :Ericivan
             * @name : size
             * @description
             */
            private function size($subTree)
            {
                if ($subTree == null) {
                    return 0;
                }else{
                    return 1 + $this->size($subTree->leftChild) + $this->size($subTree->rightChild);
                }
            }

            /**
             * @param TreeNode $element
             * @return null
             * @author :Ericivan
             * @name : getLeftChildNode
             * @description 获取左节点
             */
            public function getLeftChildNode($element)
            {
                return is_null($element) ? null : $element->leftChild;
            }

            /**
             * @param TreeNode $element
             * @return null
             * @author :Ericivan
             * @name : getRightChildNode
             * @description 获取右边节点
             */
            public function getRightChildNode($element)
            {
                return is_null($element) ? null : $element->rightChild;
            }

            /**
             * @return null|TreeNode
             * @author :Ericivan
             * @name : getRoot
             * @description 获取根节点
             */
            public function getRoot()
            {
                return $this->root;
            }


            public function destroy($treeNode)
            {
                if (!is_null($treeNode)) {
                    $this->destroy($treeNode->leftChild);

                    $this->destroy($treeNode->rightChild);

                    $subTree = null;
                }
            }

            public function traverse($treeNode)
            {
                print_r("key:{$treeNode->key} --name: {$treeNode->data} \n");
                $this->traverse($treeNode->leftChild);
                $this->traverse($treeNode->rightChild);
            }

            /**
             * @param TreeNode $subTree
             * @author :Ericivan
             * @name : preOrder
             * @description 前序遍历
             */
            public function preOrder($subTree)
            {
                if (!is_null($subTree)) {
                    $this->visited($subTree);
                    $this->preOrder($subTree->leftChild);
                    $this->preOrder($subTree->rightChild);
                }
            }

            /**
             * @param TreeNode $subTree
             * @author :Ericivan
             * @name : inOrder
             * @description 中序遍历
             */
            public function inOrder($subTree)
            {
                if (!is_null($subTree)) {
                    $this->inOrder($subTree->leftChild);
                    $this->visited($subTree);
                    $this->inOrder($subTree->rightChild);
                }
            }

            /**
             * @param TreeNode $subTree
             * @author :Ericivan
             * @name : postOrder
             * @description 后序遍历
             */
            public function postOrder($subTree)
            {
                if (!is_null($subTree)) {
                    $this->postOrder($subTree->leftChild);
                    $this->postOrder($subTree->rightChild);
                    $this->visited($subTree);
                }
            }

            private function height($subTree)
            {
                if ($subTree == null) {
                    return 0;
                }else{
                    $i = $this->height($subTree->leftChild);
                    $j = $this->height($subTree->rightChild);

                    return ($i < $j) ? ($j + 1) : ($i + 1);
                }
            }

            public function visited($subTree)
            {
                $subTree->isVisited = true;
                print_r("key:{$subTree->key} --name: {$subTree->data} \n");

            }

            /**
             * @param TreeNode $subTree
             * @param TreeNode $element
             * @return bool|null|TreeNode
             * @author :Ericivan
             * @name : parent
             * @description
             */
            private function parent($subTree,$element)
            {
                if ($subTree == null) {
                    return null;
                }

                if ($subTree->leftChild == $element || $subTree->rightChild == $element) {
                    return $subTree;
                }

                if ($p = $this->parent($subTree->leftChild, $element) != null) {
                    return $p;
                }else{
                    return $this->parent($subTree->rightChild, $element);
                }
            }


        }


        class TreeNode{
            public $key = 0;
            public $data = null;
            public $isVisited = false;
            public $leftChild = null;
            public $rightChild = null;

            public function __construct($key,$data)
            {
                $this->key = $key;
                $this->data = $data;
        $this->leftChild = null;
        $this->leftChild = null;
    }
}

$bt = new BinaryTree();

$bt->createBinaryTree($bt->root);

//print_r($bt->root);

echo "the size of tree is {$bt->getSize()} \n";

echo "*******(前序遍历)[ABDECF]遍历*****************\n";

$bt->preOrder($bt->root);

echo "*******(中序遍历)[DBEACF]遍历*****************\n";

$bt->inOrder($bt->root);

echo "*******(后序遍历)[DEBFCA]遍历*****************\n";

$bt->postOrder($bt->root);