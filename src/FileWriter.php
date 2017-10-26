<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Exceptions\FileSystemException;
use LazyEight\DiTesto\Interfaces\FileInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemHandlerInterface;
use LazyEight\DiTesto\Interfaces\FileWriterInterface;
use LazyEight\DiTesto\Interfaces\WritableFileInterface;

class FileWriter implements FileWriterInterface
{
    /**
     * @var AbstractFile
     */
    private $file;

    /**
     * @var FileSystemHandlerInterface
     */
    private $handler;

    /**
     * FileWriter constructor.
     * @param AbstractFile $file
     * @param FileSystemHandlerInterface $handler
     */
    public function __construct(AbstractFile $file, FileSystemHandlerInterface $handler)
    {
        $this->file = $file;
        $this->handler = $handler;
    }

    public function writeFile()
    {
        $this->handler->write($this->file->getRawContent());
    }
}
