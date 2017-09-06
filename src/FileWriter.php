<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
use LazyEight\DiTesto\Interfaces\FileInterface;
use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemHandlerInterface;
use LazyEight\DiTesto\Interfaces\FileWriterInterface;
use LazyEight\DiTesto\Interfaces\WritableFileInterface;

class FileWriter implements FileWriterInterface
{
    public function writeFile(FileInterface $file, FileSystemHandlerInterface $fileSystemHandler)
    {
        if (!$fileSystemHandler->isWritable($file->getPath())) {
            throw new IOException("Error, can't write to the file. The file not exists or is not writable.");
        }

        $fileSystemHandler->write($file->getPath(), $file->getRawContent());
    }
}
