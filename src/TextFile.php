<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Collections\ArrayObjectLine;
use LazyEight\DiTesto\Interfaces\TraversableFileInterface;

class TextFile extends AbstractFile implements TraversableFileInterface
{
    /**
     * @var ArrayObjectLine
     */
    private $lines;

    /**
     * @inheritDoc
     */
    public function __construct($path, $content = '')
    {
        parent::__construct($path, $content);
        $this->readLines();
    }

    private function readLines()
    {
        $this->lines = new ArrayObjectLine(array_map(function ($line) {
            return new Line($line);
        }, explode(PHP_EOL, parent::getRawContent())));
    }

    public function getRawContent(): string
    {
        return $this->lines->getRawContent();
    }

    public function setRawContent(string $content)
    {
        parent::setRawContent($content);
        $this->readLines();
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return $this->lines->getIterator();
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->lines->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->lines->offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->lines->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->lines->offsetUnset($offset);
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->lines->count();
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->getRawContent();
    }
}
