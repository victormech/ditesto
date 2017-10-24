<?php

namespace LazyEight\DiTesto\FileSystem;

use LazyEight\DiTesto\FileSystem\Exceptions\FileSystemException;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemPathInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemReaderInterface;
use LazyEight\DiTesto\FileSystem\Exceptions\InvalidPathException;

class FileSystemReader implements FileSystemReaderInterface
{
    /**
     * @var FileSystemPathInterface
     */
    private $path;

    /**
     * FileSystemReader constructor.
     * @param FileSystemPathInterface $path
     */
    public function __construct(FileSystemPathInterface $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function isReadable(): bool
    {
        return is_readable($this->path->rawPath());
    }

    /**
     * @inheritDoc
     */
    public function read(): string
    {
        $this->validate();

        return file_get_contents($this->path->rawPath());
    }

    /**
     * @throws FileSystemException
     * @throws InvalidPathException
     */
    private function validate()
    {
        if ($this->path->isDirectory()) {
            throw new InvalidPathException("Error, can't read content from a directory.");
        }

        if (!$this->isReadable()) {
            throw new FileSystemException("Error, can't read the file. The file not exists or is not readable.");
        }
    }
}
