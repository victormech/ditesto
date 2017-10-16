<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
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
        if (!$this->handler->isWritable()) {
            throw new IOException("Error, can't write to the file. The file not exists or is not writable.");
        }

        $this->handler->write($this->file->getRawContent());
    }
}
