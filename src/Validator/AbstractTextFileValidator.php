<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 10/04/16
 * Time: 23:42
 */

namespace LazyEight\DiTesto\Validator;


use LazyEight\DiTesto\ValueObject\FileLocation;

abstract class AbstractTextFileValidator
{
    /**
     * @var string
     */
    private $allowedMimeType = 'text/plain';

    /**
     * @return bool
     */
    abstract public function validate();

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
            throw new InvalidFileTypeException($this->getFileContentErrorMessage($rawInfo));
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