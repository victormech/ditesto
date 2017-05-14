<?php

namespace LazyEight\DiTesto\Validator;

use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\ValueObject\FileLocation;

/**
 * Class AbstractTextFileValidator
 * @package LazyEight\DiTesto\Validator
 */
abstract class AbstractTextFileValidator
{
    /**
     * @var string
     */
    private $allowedMimeType = 'text/plain';

    /**
     * @return bool
     */
    abstract public function validate() : bool;

    /**
     * @throws InvalidFileLocationException If file not exists
     */
    protected function validateFileLocation()
    {
        if (!file_exists($this->getFileLocation()->getValue())) {
            throw new InvalidFileLocationException('File not exists!', 101);
        }
    }

    /**
     * @throws InvalidFileTypeException
     */
    protected function validateFileContent()
    {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $rawInfo = finfo_file($fileInfo, $this->getFileLocation()->getValue());

        if ($rawInfo !== $this->allowedMimeType) {
            throw new InvalidFileTypeException($this->getFileContentErrorMessage($rawInfo), 102);
        }
    }

    /**
     * @return FileLocation
     */
    abstract protected function getFileLocation();

    /**
     * @param $rawInfo object created by finfo_file function
     * @return string Error message for when the things going wrong with the mimeType of the file
     */
    protected function getFileContentErrorMessage($rawInfo)
    {
        return 'Invalid file type. Found '. $rawInfo . ' when ' .$this->allowedMimeType . ' was expected';
    }
}
