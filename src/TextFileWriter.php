<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
use LazyEight\DiTesto\Interfaces\FileWriterInterface;
use LazyEight\DiTesto\Interfaces\WritableFileInterface;

class TextFileWriter implements FileWriterInterface
{
    /**
     * @inheritDoc
     */
    public function writeFile(WritableFileInterface $file)
    {
        if (!$file->isWritable()) {
            throw new IOException("Can't write the file. Permission denied");
        }

        $file->write();
    }
}
