<?php

use App\UpdateNames\JsonFileUpdateNamesInCategoryTree;

require dirname(__DIR__) . '/vendor/autoload.php';


$updateNamesInCategoryTree = new JsonFileUpdateNamesInCategoryTree(
    dirname(__DIR__) . '/resources/list.json',
    dirname(__DIR__) . '/resources/tree.json',
    dirname(__DIR__) . '/resources/output.json'
);
try {
    $updateNamesInCategoryTree->update();
} catch (Exception $exception) {
    echo $exception->getMessage();
}