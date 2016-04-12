<?php
/**
 * Created by PhpStorm.
 * User: Victor Ribeiro <victormech@gmail.com>
 * Date: 10/04/16
 */

namespace LazyEight\DiTesto;


use LazyEight\DiTesto\Validator\TextFileWriterValidator;
use LazyEight\DiTesto\ValueObject\TextFile\TextFile;

class TextFileWriter
{
    /**
     * @var TextFile
     */
    protected $file;

    /**
     * @param TextFile $file
     */
    public function __construct(TextFile $file)
    {
        $this->file = clone $file;
    }

    /**
     * write file to disk
     */
    public function writeFile()
    {
        $this->validateFile();
        $this->writeFileToDisk();
    }

    /**
     * Writes the file to disk
     */
    protected function writeFileToDisk()
    {
        file_put_contents($this->file->getLocation()->getValue());
    }

    /**
     * @return bool
     */
    protected function validateFile()
    {
        return (new TextFileWriterValidator($this->file))->validate();
    }
}
