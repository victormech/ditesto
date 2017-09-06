<?php

namespace LazyEight\DiTesto\Interfaces;

use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemHandlerInterface;

interface FileReaderInterface
{
    /**
     * Read the file content from a file system.
     * @param FileInterface $file
     * @param FileSystemHandlerInterface $fileSystemHandler
     * @return void
     */
    public function readFile(FileInterface $file, FileSystemHandlerInterface $fileSystemHandler);
}
