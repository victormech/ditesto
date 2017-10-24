<?php

namespace LazyEight\DiTesto\FileSystem;

use LazyEight\DiTesto\Exceptions\FileSystemException;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemPathInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemWriterInterface;
use Test\DiTesto\FileSystem\Exceptions\InvalidPathException;

class FileSystemWriter implements FileSystemWriterInterface
{
    /**
     * @var FileSystemPathInterface
     */
    private $path;

    /**
     * FileSystemWriter constructor.
     * @param FileSystemPathInterface $path
     */
    public function __construct(FileSystemPathInterface $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function isWritable(): bool
    {
        return is_writable($this->path->rawPath());
    }

    /**
     * @inheritDoc
     */
    public function write(string $content)
    {
        $this->validate();
        file_put_contents($this->path->rawPath(), $content);
    }

    /**
     * @throws FileSystemException
     * @throws InvalidPathException
     */
    public function validate()
    {
        if ($this->path->isDirectory()) {
            throw new InvalidPathException("Error, can't write file content to a directory.");
        }

        if (!is_writable($this->path->pathName()) && !$this->isWritable()) {
            throw new FileSystemException("Error, can't write to the file. The file must be writable.");
        }
    }
}