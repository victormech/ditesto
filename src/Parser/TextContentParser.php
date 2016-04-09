<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 09/04/16
 */

namespace LazyEight\DiTesto\Parser;


use LazyEight\DiTesto\ValueObject\AbstractFileContent;
use LazyEight\DiTesto\ValueObject\TextFile\Line;
use LazyEight\DiTesto\ValueObject\TextFile\TextContent;

class TextContentParser
{
    /**
     * @var AbstractFileContent
     */
    private $content;

    /**
     * @param AbstractFileContent $content
     */
    public function __construct(AbstractFileContent $content)
    {
        $this->content = $content;
    }

    /**
     * @return TextContent
     */
    public function parse()
    {
        $lines = $this->convertContentToLines();
        return new TextContent($this->content->getValue(), $lines);
    }

    /**
     * @return array
     */
    protected function convertContentToLines()
    {
        $lines = array();
        $arrLines = $this->content->getValue()->split('\n');
        foreach ($arrLines as $value) {
            $lines[] = new Line($value);
        }
        return $lines;
    }
}