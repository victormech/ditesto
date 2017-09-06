<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
use LazyEight\DiTesto\Interfaces\FileInterface;
use LazyEight\DiTesto\Interfaces\FileReaderInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemHandlerInterface;

class FileReader implements FileReaderInterface
{
    /**
     * @inheritDoc
     */
    public function readFile(FileInterface $file, FileSystemHandlerInterface $fileSystemHandler)
    {
        if (!$fileSystemHandler->isReadable($file->getPath())) {
            throw new IOException("Error, can't read the file. The file not exist or is not readable.");
        }

        $file->setRawContent($fileSystemHandler->read($file->getPath()));
    }
}
