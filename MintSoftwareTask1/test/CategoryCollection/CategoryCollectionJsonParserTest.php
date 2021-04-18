<?php

namespace Tests\CategoryCollection;

use App\Category\NullCategory;
use App\CategoryCollection\CategoryCollectionJsonParser;
use PHPUnit\Framework\TestCase;

class CategoryCollectionJsonParserTest extends TestCase
{
    private static string $exampleData =
        '[{"category_id":"1","order":"2","root":"1","in_loyalty":"0","translations":{"pl_PL":
        {"trans_id":"1","category_id":"1","name":"Kobiety","description":"","active":"1","pres_id":null,"isdefault":"1"
        ,"lang_id":"1","seo_title":"","seo_description":"","seo_keywords":"","seo_url":"","items":1,
        "attribute_groups":[1,2]}}}]';

    public function testCanParse()
    {
        $categoryCollectionJson = json_decode(self::$exampleData);
        $categoryCollectionJsonParser = new CategoryCollectionJsonParser($categoryCollectionJson);
        $categoryCollection = $categoryCollectionJsonParser->parse();
        $category = $categoryCollection->getCategory(1);
        $this->assertEquals(
            1,
            $category->getId()
        );
        $this->assertEquals(
            'Kobiety',
            $category->getName()
        );

    }

    public function testCannotFindUnsetElements()
    {
        $categoryCollectionJson = json_decode(self::$exampleData);
        $categoryCollectionJsonParser = new CategoryCollectionJsonParser($categoryCollectionJson);
        $categoryCollection = $categoryCollectionJsonParser->parse();
        $category = $categoryCollection->getCategory(100);
        $this->assertInstanceOf(
            NullCategory::class,
            $category
        );

    }
}
