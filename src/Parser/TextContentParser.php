<?php

namespace LazyEight\DiTesto\Parser;

use LazyEight\BasicTypes\JString;
use LazyEight\DiTesto\ValueObject\AbstractFileContent;
use LazyEight\DiTesto\ValueObject\TextFile\Line;
use LazyEight\DiTesto\ValueObject\TextFile\TextContent;

/**
 * Class TextContentParser
 * @package LazyEight\DiTesto\Parser
 */
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
    public function parse() : TextContent
    {
        return new TextContent($this->content->getValue(), $this->convertContentToLines());
    }

    /**
     * @return array
     */
    protected function convertContentToLines() : array
    {
        $lines = array();
        $jContent = new JString($this->content->getValue());
        $arrLines = $jContent->split('\n');
        foreach ($arrLines as $value) {
            $lines[] = new Line($value);
        }

        return $lines;
    }
}
