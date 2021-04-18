<?php


namespace App\UpdateNames;


use App\CategoryCollection\CategoryCollectionInterface;
use App\CategoryCollection\CategoryCollectionJsonParser;
use App\JsonFile\JsonFileReader;
use App\JsonFile\JsonFileWriter;
use App\TreeIterator\TreeIterator;
use App\TreeIterator\TreeJsonIterator;

class JsonFileUpdateNamesInCategoryTree extends UpdateNamesInCategoryTree
{
    private string $categoryNamesFilename;
    private string $treeFilename;
    private string $outputFilename;

    /**
     * UpdateNamesInCategoryTree constructor.
     * @param string $categoryNamesFilename
     * @param string $treeFilename
     * @param string $outputFilename
     */
    public function __construct(string $categoryNamesFilename, string $treeFilename, string $outputFilename)
    {
        $this->categoryNamesFilename = $categoryNamesFilename;
        $this->treeFilename = $treeFilename;
        $this->outputFilename = $outputFilename;
    }

    protected function computeCategoryCollection(): CategoryCollectionInterface
    {
        $categoryNamesJson = (new JsonFileReader($this->categoryNamesFilename))->read();
        $categoryCollectionParser = new CategoryCollectionJsonParser($categoryNamesJson);
        return $categoryCollectionParser->parse();
    }

    protected function computeTreeIterator(): TreeIterator
    {
        $treeJson = (new JsonFileReader($this->treeFilename))->read();
        return new TreeJsonIterator($treeJson);
    }

    protected function outputTree(array $tree): void
    {
        $jsonFileWriter = new JsonFileWriter($this->outputFilename);
        $jsonFileWriter->write($tree);
    }
}