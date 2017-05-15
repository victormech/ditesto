<?php

namespace LazyEight\DiTesto\ValueObject\TextFile;

use LazyEight\BasicTypes\Exceptions\IndexOutOfBoundsException;
use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\ValueObject\AbstractFileContent;

/**
 * Class TextContent
 * @package LazyEight\DiTesto\ValueObject\TextFile
 */
class TextContent extends AbstractFileContent
{
    /*
     * @var array
     */
    private $lines;

    /**
     * @inheritDoc
     */
    public function __construct(string $content, array $lines)
    {
        parent::__construct($content);
        $this->lines = $lines;
    }

    /**
     * @return array
     */
    public function getLines() : array
    {
        return $this->lines;
    }

    /**
     * @param int $index
     * @throws IndexOutOfBoundsException
     * @return Line
     */
    public function lineAt($index) : Line
    {
        if (0 > $index || ($this->count() - 1) < $index) {
            throw new IndexOutOfBoundsException('The index is negative or not less than the length of the array.');
        }

        return clone $this->lines[$index];
    }

    /**
     * @return Line
     */
    public function firstLine() : Line
    {
        return clone $this->lines[0];
    }

    /**
     * @return Line
     */
    public function lastLine() : Line
    {
        return clone $this->lines[count($this->lines) - 1];
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return count($this->lines);
    }
}
