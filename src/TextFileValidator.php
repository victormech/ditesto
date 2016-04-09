<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto;


use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\ValueObject\FileLocation;

class TextFileValidator
{
    /**
     * @var FileLocation
     */
    protected $location;

    /**
     * @var string
     */
    private $allowedMimeType = 'text/plain';

    /**
     * @param FileLocation $location
     */
    public function __construct(FileLocation $location)
    {
        $this->location = $location;
    }
	
    /**
     * @throws InvalidFileLocationException
     * @throws InvalidFileTypeException
     * @return bool
     */
    public function validate()
    {
        $this->validateFileLocation();
        $this->validateFileContent();
        return true;
    }

    /**
     * @throws InvalidFileLocationException If file not exists
     */
    protected function validateFileLocation()
    {
        if (!file_exists($this->location->getValue())) {
            throw new InvalidFileLocationException('File not exists!', 101);
        }
    }

    /**
     * @throws InvalidFileTypeException
     */
    protected function validateFileContent()
    {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $rawInfo = finfo_file($fileInfo, $this->location->getValue());
        if ($rawInfo !== $this->allowedMimeType) {
            throw new InvalidFileTypeException($this->getFileContentErrorMessage($rawInfo));
        }
    }
	
    /**
     * @return FileLocation
     */
    public function getFileLocation()
    {
        return clone $this->location;
    }

    /**
     * @param $rawInfo object created by finfo_file function
     * @return string Error message for when the things going wrong with the mimeType of the file
     */
    protected function getFileContentErrorMessage($rawInfo)
    {
        return 'Invalid file type. Found '. $rawInfo . ' when ' .$this->allowedMimeType . ' was expected';
    }
}
