<?php


namespace Tests\CategoryCollection;



use App\Category\Category;
use App\Category\NullCategory;
use App\CategoryCollection\CategoryCollection;
use PHPUnit\Framework\TestCase;

class CategoryCollectionTest extends TestCase
{
    public function testCanSetOneElement(): void {
        $category = new Category(1, 'Ubrania');
        $categoryCollection = new CategoryCollection();
        $categoryCollection->setCategory($category);
        $this->assertSame(
            $category,
            $categoryCollection->getCategory(1)
        );
    }

    public function testCanResetElement(): void {
        $categoryFirst = new Category(1, 'Ubrania');
        $categorySecond = new Category(1, 'Buty');
        $categoryCollection = new CategoryCollection();
        $categoryCollection->setCategory($categoryFirst);
        $categoryCollection->setCategory($categorySecond);
        $this->assertSame(
            $categorySecond,
            $categoryCollection->getCategory(1)
        );
    }

    public function testReturnNullObjectWhenIdIsUnset(): void {
        $categoryCollection = new CategoryCollection();
        $this->assertInstanceOf(
            NullCategory::class,
            $categoryCollection->getCategory(1)
        );
    }
}