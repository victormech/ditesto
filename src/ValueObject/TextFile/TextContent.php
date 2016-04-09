<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 09/04/16
 * Time: 05:01
 */

namespace LazyEight\DiTesto\ValueObject\TextFile;


use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\ValueObject\AbstractFileContent;

class TextContent extends AbstractFileContent
{
    /*
     * @var array
     */
    private $lines;

    /**
     * @inheritDoc
     */
    public function __construct(Stringy $content, array $lines)
    {
        parent::__construct($content);
        $this->lines = $lines;
    }

    /**
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * @param int $index
     * @return Line
     */
    public function lineAt($index)
    {
        return clone $this->lines[$index];
    }

    /**
     * @return Line
     */
    public function firstLine()
    {
        return clone $this->lines[0];
    }

    /**
     * @return Line
     */
    public function lastLine()
    {
        return clone $this->lines[count($this->lines) - 1];
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->lines);
    }
}
