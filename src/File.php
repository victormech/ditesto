<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Interfaces\FileInterface;

class File implements FileInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $content;

    /**
     * File constructor.
     * @param string $path
     * @param string $content
     */
    public function __construct(string $path, string $content = '')
    {
        $this->path = $path;
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function getRawContent(): string
    {
        return $this->content;
    }

    /**
     * @inheritDoc
     */
    public function setRawContent(string $content)
    {
        $this->content = $content;
    }

    public function __toString()
    {
        return (string) $this->content;
    }
}
