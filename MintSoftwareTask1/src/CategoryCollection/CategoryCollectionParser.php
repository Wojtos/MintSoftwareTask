<?php


namespace App\CategoryCollection;


interface CategoryCollectionParser
{
    public function parse(): CategoryCollection;
}