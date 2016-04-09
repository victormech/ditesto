<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 09/04/16
 */

namespace LazyEight\DiTesto\Parser;


use LazyEight\DiTesto\ValueObject\AbstractFileContent;
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
        return new TextContent($this->content->getValue(), array());
    }
}