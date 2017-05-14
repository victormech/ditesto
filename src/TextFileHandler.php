<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\ValueObject\FileLocation;
use LazyEight\DiTesto\ValueObject\TextFile\TextFile;

class TextFileHandler
{
    /**
     * Load file from disk
     *
     * @throws InvalidFileLocationException
     * @throws InvalidFileTypeException
     * @param FileLocation $location
     * @return TextFile
     */
    public function loadFileFromPath(FileLocation $location) : TextFile
    {
        return (new TextFileLoader($location))->loadFile();
    }

    /**
     * @param TextFile $file
     */
    public function writeFile(TextFile $file)
    {
        (new TextFileWriter($file))->writeFile();
    }
}
