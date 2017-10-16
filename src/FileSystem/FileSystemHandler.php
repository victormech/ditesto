<?php

namespace LazyEight\DiTesto\FileSystem;

use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemHandlerInterface;

class FileSystemHandler implements FileSystemHandlerInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * FileSystemHandler constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function exists(): bool
    {
        return file_exists($this->path);
    }

    /**
     * @inheritDoc
     */
    public function isReadable(): bool
    {
        return is_readable($this->path);
    }

    /**
     * @inheritDoc
     */
    public function isWritable(): bool
    {
        if (!$this->exists() && is_writable($this->pathName())) {
            return true;
        }

        return is_writable($this->path);
    }

    /**
     * @inheritDoc
     */
    public function pathName(): string
    {
        return dirname($this->path);
    }

    /**
     * @inheritDoc
     */
    public function filename(): string
    {
        return basename($this->path);
    }

    /**
     * @inheritDoc
     */
    public function size(): int
    {
        return filesize($this->path);
    }

    /**
     * @inheritDoc
     */
    public function type(): string
    {
        return mime_content_type($this->path);
    }

    /**
     * @inheritDoc
     */
    public function read(): string
    {
        return file_get_contents($this->path);
    }

    /**
     * @inheritDoc
     */
    public function write(string $content)
    {
        file_put_contents($this->path, $content);
    }
}
