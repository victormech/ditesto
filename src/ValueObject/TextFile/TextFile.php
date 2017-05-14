<?php

namespace LazyEight\DiTesto\ValueObject\TextFile;

use LazyEight\DiTesto\ValueObject\File;
use LazyEight\DiTesto\ValueObject\FileContent;
use LazyEight\DiTesto\ValueObject\FileLocation;

class TextFile extends File
{
    /**
     * @var TextContent
     */
    private $textContent;

    /**
     * @inheritDoc
     */
    public function __construct(FileLocation $location, FileContent $content, TextContent $textContent)
    {
        parent::__construct($location, $content);
        $this->textContent = $textContent;
    }

    /**
     * @return TextContent
     */
    public function getTextContent()
    {
        return clone $this->textContent;
    }
}
