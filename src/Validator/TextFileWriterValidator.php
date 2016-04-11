<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 10/04/16
 * Time: 23:33
 */

namespace LazyEight\DiTesto\Validator;


use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\ValueObject\FileLocation;
use LazyEight\DiTesto\ValueObject\TextFile\TextFile;

class TextFileWriterValidator extends AbstractTextFileValidator
{
    /**
     * @var TextFile
     */
    private $file;

    /**
     * TextFileWriterValidator constructor.
     * @param TextFile $file
     */
    public function __construct(TextFile $file)
    {
        $this->file = $file;
    }

    /**
     * @throws InvalidFileLocationException
     * @throws InvalidFileTypeException
     * @return bool
     */
    public function validate()
    {
        $this->validateFilePath();
        return true;
    }

    /**
     * @throws InvalidFileLocationException
     */
    protected function validateFilePath()
    {
        $fileDir = $this->file->getLocation()->getFileDirectory();
        if (!is_writable($fileDir->getValue())) {
            throw new InvalidFileLocationException("The directory {$fileDir->getValue()} is not writable.");
        }
    }

    /**
     * @inheritDoc
     */
    protected function getFileLocation()
    {
        return $this->file->getLocation();
    }
}