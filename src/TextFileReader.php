<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
use LazyEight\DiTesto\Interfaces\FileReaderInterface;
use LazyEight\DiTesto\Interfaces\ReadableFileInterface;

class TextFileReader implements FileReaderInterface
{
    /**
     * @inheritDoc
     */
    public function readFile(ReadableFileInterface $file)
    {
        if (!$file->isReadable()) {
            throw new IOException("Error. The file is not readable.");
        }

        $file->read();
    }
}
