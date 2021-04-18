<?php


namespace App\TreeIterator;

use \SplQueue;
use \stdClass;

class TreeJsonIterator implements TreeIterator
{
    private array $treeJson;
    private ?stdClass $currentElement;
    private SplQueue $queue;


    public function __construct(array $treeJson)
    {
        $this->treeJson = $treeJson;
        $this->currentElement = null;
        $this->rewind();
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->currentElement;
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        if($this->currentElement || !$this->queue->isEmpty()) {
            foreach ($this->currentElement->children as $child) {
                $this->queue->enqueue($child);
            }
            $this->currentElement = !$this->queue->isEmpty() ? $this->queue->dequeue() : null;
        }
    }

    /**
     * @inheritDoc
     */
    public function key(): int
    {
        return $this->currentElement->id;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return $this->currentElement !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->queue = new SplQueue();
        foreach ($this->treeJson as $child) {
            $this->queue->enqueue($child);
        }
        $this->currentElement = $this->queue->dequeue();
    }

    public function getTree(): array
    {
        return $this->treeJson;
    }
}
