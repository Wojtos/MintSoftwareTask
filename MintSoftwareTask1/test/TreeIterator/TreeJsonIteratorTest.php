<?php

namespace Tests\TreeIterator;

use App\TreeIterator\TreeJsonIterator;
use PHPUnit\Framework\TestCase;

class TreeJsonIteratorTest extends TestCase
{
    private static $jsonString = '[{"id":19,"children":[{"id":20,"children":[]},{"id":21,"children":[]},
    {"id":22,"children":[{"id":26,"children":[{"id":30,"children":[]},{"id":31,"children":[]},{"id":32,"children":[]},
    {"id":33,"children":[]}]},{"id":27,"children":[]},{"id":28,"children":[{"id":29,"children":[]}]}]},
    {"id":23,"children":[]},{"id":24,"children":[]},{"id":25,"children":[]}]},{"id":34,"children":[{"id":
    38,"children":[{"id":43,"children":[{"id":46,"children":[]},{"id":47,"children":[]},{"id":48,"children":[]}]},
    {"id":44,"children":[]},{"id":45,"children":[]}]},{"id":39,"children":[]},{"id":40,"children":[]},{"id":41,
    "children":[]},{"id":42,"children":[]}]},{"id":35,"children":[{"id":49,"children":[{"id":53,"children":[]},
    {"id":54,"children":[]}]},{"id":50,"children":[]},{"id":51,"children":[]},{"id":52,"children":[]}]},
    {"id":36,"children":[{"id":55,"children":[{"id":61,"children":[]},{"id":62,"children":[]},{"id":64,"children":
    [{"id":65,"children":[]},{"id":66,"children":[]}]}]},{"id":56,"children":[]},{"id":57,"children":[]},
    {"id":58,"children":[]},{"id":59,"children":[]},{"id":60,"children":[]}]},{"id":37,"children":[]},
    {"id":1,"children":[{"id":14,"children":[]},{"id":3,"children":[]},{"id":2,"children":[]},
    {"id":11,"children":[]},{"id":13,"children":[]}]}]';

    public function testValidOrder() {
        $iterator = new TreeJsonIterator(json_decode(self::$jsonString));
        $this->assertEquals(
            19,
            $iterator->current()->id
        );
        $iterator->next();
        $this->assertEquals(
            34,
            $iterator->current()->id
        );
        $iterator->next();
        $this->assertEquals(
            35,
            $iterator->current()->id
        );
        $iterator->next();
        $this->assertEquals(
            36,
            $iterator->current()->id
        );
        $iterator->next();
        $this->assertEquals(
            37,
            $iterator->current()->id
        );
        $iterator->next();
        $this->assertEquals(
            1,
            $iterator->current()->id
        );
        $iterator->next();
        $this->assertEquals(
            20,
            $iterator->current()->id
        );
    }

    public function testCorrectLength() {
        $iterator = new TreeJsonIterator(json_decode(self::$jsonString));
        $counter = 0;
        foreach ($iterator as $item) {
            $counter++;
        }
        $this->assertEquals(
            53,
            $counter
        );
    }
}
