<?php
/**
 * Created by PhpStorm.
 * User: Victor Ribeiro <victormech@gmail.com>
 * Date: 10/04/16
 */

namespace LazyEight\DiTesto;


use LazyEight\DiTesto\ValueObject\File;

class TextFileWriter
{
    /**
     * @var File
     */
    protected $file;

    /**
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = clone $file;
    }

    public function writeFile()
    {
        $this->validateFile();
    }

    protected function validateFile()
    {

    }
}