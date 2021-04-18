<?php

namespace App\CategoryCollection;

use App\Category\Category;
use App\Category\NullCategory;

class CategoryCollection implements CategoryCollectionInterface
{
    private array $categoriesMappedById = [];

    public function setCategory(Category $category): CategoryCollectionInterface
    {
        $this->categoriesMappedById[$category->getId()] = $category;

        return $this;
    }

    public function getCategory(int $categoryId): Category
    {
        return $this->categoriesMappedById[$categoryId] ?? new NullCategory();
    }
}