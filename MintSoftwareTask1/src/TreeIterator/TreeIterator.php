<?php


namespace App\TreeIterator;

use \Iterator;

interface TreeIterator extends Iterator
{
    public function getTree(): array;
}