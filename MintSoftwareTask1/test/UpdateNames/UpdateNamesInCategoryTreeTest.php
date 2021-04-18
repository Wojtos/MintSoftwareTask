<?php

namespace Tests\UpdateNames;

use App\Category\Category;
use App\CategoryCollection\CategoryCollection;
use App\CategoryCollection\CategoryCollectionInterface;
use App\TreeIterator\TreeIterator;
use App\TreeIterator\TreeJsonIterator;
use App\UpdateNames\UpdateNamesInCategoryTree;
use PHPUnit\Framework\TestCase;
use stdClass;

class UpdateNamesInCategoryTreeTest extends TestCase
{
    public function testUpdate()
    {
        $mockUpdateNames = new class extends UpdateNamesInCategoryTree {
            protected function computeCategoryCollection(): CategoryCollectionInterface
            {
                $categoryCollection = new CategoryCollection();
                $categoryCollection->setCategory(new Category(2, "Cow"));
                return $categoryCollection;
            }

            protected function computeTreeIterator(): TreeIterator
            {
                $innerObject = new stdClass();
                $innerObject->id = 2;
                $innerObject->children = [];
                $outerObject = new stdClass();
                $outerObject->id = 1;
                $outerObject->children = [$innerObject];
                $tree = [$outerObject];
                return new TreeJsonIterator($tree);
            }

            protected function outputTree(array $tree): void
            {
                $outerObject = $tree[0];
                TestCase::assertEquals(
                    "",
                    $outerObject->name
                );
                $innerObject = $outerObject->children[0];
                TestCase::assertEquals(
                    "Cow",
                    $innerObject->name
                );
            }
        };
        $mockUpdateNames->update();
    }
}