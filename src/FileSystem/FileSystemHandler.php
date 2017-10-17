<?php

namespace LazyEight\DiTesto\FileSystem;

use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemHandlerInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemPathInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemReaderInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemWriterInterface;

class FileSystemHandler implements FileSystemHandlerInterface
{
    /**
     * @var FileSystemPathInterface
     */
    private $path;

    /**
     * @var FileSystemReaderInterface
     */
    private $fileReader;

    /**
     * @var FileSystemWriterInterface
     */
    private $fileWriter;

    /**
     * FileSystemHandler constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = new FileSystemPath($path);
        $this->fileReader = new FileSystemReader($this->path);
        $this->fileWriter = new FileSystemWriter($this->path);
    }

    /**
     * @return FileSystemPath
     */
    public function getPath(): FileSystemPathInterface
    {
        return clone $this->path;
    }

    /**
     * @inheritDoc
     */
    public function readable(): bool
    {
        return $this->fileReader->isReadable();
    }

    /**
     * @inheritDoc
     */
    public function writable(): bool
    {
        return $this->fileWriter->isWritable();
    }

    /**
     * @inheritDoc
     */
    public function read(): string
    {
        return $this->fileReader->read();
    }

    /**
     * @inheritDoc
     */
    public function write(string $content)
    {
        $this->fileWriter->write($content);
    }
}
