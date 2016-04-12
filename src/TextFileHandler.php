<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 10/04/16
 * Time: 23:46
 */

namespace LazyEight\DiTesto;


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
    public function loadFileFromPath(FileLocation $location)
    {
        $fileLoader = new TextFileLoader($location);
        return $fileLoader->loadFile();
    }

    /**
     * @param TextFile $file
     */
    public function writeFile(TextFile $file)
    {
        $fileWriter = new TextFileWriter($file);
        $fileWriter->writeFile();
    }
}