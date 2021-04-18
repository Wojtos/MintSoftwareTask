<?php


namespace App\UpdateNames;

use App\CategoryCollection\CategoryCollectionInterface;
use App\TreeIterator\TreeIterator;

abstract class UpdateNamesInCategoryTree
{
    protected abstract function computeCategoryCollection(): CategoryCollectionInterface;
    protected abstract function computeTreeIterator(): TreeIterator;
    protected abstract function outputTree(array $tree): void;


    public function update(): void {
        $categoryCollection = $this->computeCategoryCollection();
        $treeIterator = $this->computeTreeIterator();

        foreach ($treeIterator as $treeNode) {
            $categoryId = $treeNode->id;
            $treeNode->name = $categoryCollection->getCategory($categoryId)->getName();
        }

        $this->outputTree($treeIterator->getTree());
    }


}
