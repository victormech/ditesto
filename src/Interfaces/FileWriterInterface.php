<?php

namespace LazyEight\DiTesto\Interfaces;

use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemHandlerInterface;

interface FileWriterInterface
{
    /**
     * Write a file to a file system.
     * @param FileInterface $file
     * @param FileSystemHandlerInterface $fileSystemHandler
     * @return void
     */
    public function writeFile(FileInterface $file, FileSystemHandlerInterface $fileSystemHandler);
}
