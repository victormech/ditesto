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
     * @return bool
     */
    public function validate()
    {
        return $this->validateFilePath();
    }

    /**
     * @throws InvalidFileLocationException
     * @return bool
     */
    protected function validateFile()
    {
        if ($this->file->exists()) {
            return $this->validateIsWriteable();
        }
        return $this->validateFilePath();
    }

    /**
     * @throws InvalidFileLocationException
     * @return bool
     */
    protected function validateIsWriteable()
    {
        if (!$this->file->isWritable()) {
            throw new InvalidFileLocationException('The file is not writable.', 104);
        }
        return true;
    }

    /**
     * @throws InvalidFileLocationException
     * @return bool
     */
    protected function validateFilePath()
    {
        $fileDir = $this->file->getLocation()->getFileDirectory();
        if (!is_writable($fileDir->getValue())) {
            throw new InvalidFileLocationException("The directory {$fileDir->getValue()} is not writable.", 103);
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function getFileLocation()
    {
        return $this->file->getLocation();
    }
}