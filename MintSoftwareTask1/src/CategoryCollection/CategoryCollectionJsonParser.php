<?php


namespace App\CategoryCollection;

use App\Category\Category;

class CategoryCollectionJsonParser implements CategoryCollectionParser
{
    private array $categoryCollectionJson;

    public function __construct(array $categoryCollectionJson)
    {
        $this->categoryCollectionJson = $categoryCollectionJson;
    }

    public function parse(): CategoryCollection
    {
        $categoryCollection = new CategoryCollection();
        foreach ($this->categoryCollectionJson as $category) {
            $category = new Category(
                $category->category_id,
                $category->translations->pl_PL->name
            );
            $categoryCollection->setCategory($category);
        }
        return $categoryCollection;
    }
}