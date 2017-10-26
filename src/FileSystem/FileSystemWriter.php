<?php

namespace LazyEight\DiTesto\FileSystem;

use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemPathInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemWriterInterface;
use LazyEight\DiTesto\FileSystem\Exceptions\FileSystemException;
use LazyEight\DiTesto\FileSystem\Exceptions\InvalidPathException;

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
     * @return bool
     */
    private function isWritablePath()
    {
        return is_writable($this->path->pathName());
    }

    /**
     * @throws FileSystemException
     * @throws InvalidPathException
     */
    private function validate()
    {
        $this->validateIsDirectory();
        $this->validatePathIsWritable();
        $this->validateWritableFile();
    }

    /**
     * @throws InvalidPathException
     */
    private function validateIsDirectory()
    {
        if ($this->path->isDirectory()) {
            throw new InvalidPathException("Error, can't write file content to a directory.");
        }
    }

    /**
     * @throws FileSystemException
     */
    private function validatePathIsWritable()
    {
        if (!file_exists($this->path->rawPath()) && !$this->isWritablePath()) {
            throw new FileSystemException("Error, can't write to the file. The path must be writable.");
        }
    }

    /**
     * @throws FileSystemException
     */
    private function validateWritableFile()
    {
        if (file_exists($this->path->rawPath()) && !$this->isWritable()) {
            throw new FileSystemException("Error, can't write to the file. The file must be writable.");
        }
    }
}
