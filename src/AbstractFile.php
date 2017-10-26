<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Interfaces\PrintableContentInterface;

abstract class AbstractFile implements PrintableContentInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $rawContent;

    /**
     * AbstractFile constructor.
     * @param string $path
     * @param string $content
     */
    public function __construct(string $path, string $content = '')
    {
        $this->path = $path;
        $this->rawContent = $content;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getRawContent(): string
    {
        return $this->rawContent;
    }

    /**
     * @param string $rawContent
     */
    public function setRawContent(string $rawContent)
    {
        $this->rawContent = $rawContent;
    }
}
