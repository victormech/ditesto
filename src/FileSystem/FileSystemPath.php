<?php

namespace LazyEight\DiTesto\FileSystem;

use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemPathInterface;

class FileSystemPath implements FileSystemPathInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * FileSystemPath constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function rawPath(): string
    {
        return $this->path;
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
    public function exists(): bool
    {
        return file_exists($this->path);
    }

    /**
     * @inheritDoc
     */
    public function isDirectory(): bool
    {
        return is_dir($this->path);
    }
}
