<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
use LazyEight\DiTesto\Interfaces\FileReaderInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemHandlerInterface;

class FileReader implements FileReaderInterface
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

    /**
     * @inheritDoc
     */
    public function readFile()
    {
        if (!$this->handler->isReadable()) {
            throw new IOException("Error, can't read the file. The file not exist or is not readable.");
        }

        $this->file->setRawContent($this->handler->read());
    }
}
