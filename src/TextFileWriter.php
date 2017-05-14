<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Validator\TextFileWriterValidator;
use LazyEight\DiTesto\ValueObject\TextFile\TextFile;

/**
 * Class TextFileWriter
 * @package LazyEight\DiTesto
 */
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
        file_put_contents($this->file->getLocation()->getValue(), $this->file->getRawContent()->getValue());
    }

    /**
     * @return bool
     */
    protected function validateFile() : bool
    {
        return (new TextFileWriterValidator($this->file))->validate();
    }
}
