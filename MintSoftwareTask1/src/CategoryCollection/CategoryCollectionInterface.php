<?php

namespace App\CategoryCollection;

use App\Category\Category;

interface CategoryCollectionInterface
{
    public function setCategory(Category $category): self;
    public function getCategory(int $categoryId): Category;
}