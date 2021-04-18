<?php


namespace App\Category;


class NullCategory extends Category
{
    public function __construct()
    {
        parent::__construct(0, "");
    }
}