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
    /*
     * @var FileLocation
     */
    private $location;

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
     * @return bool
     */
    public function validate()
    {
        $this->validateFileLocation();
        $this->validateFileContent();
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

    protected function validateFileContent()
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileInfo = finfo_file($finfo, $this->location->getValue());
        if ($fileInfo !== $this->allowedMimeType) {
            $errorMsg = 'Invalid file type. Found '. $fileInfo . ' when ';
            $errorMsg .= $this->allowedMimeType . ' was expected';
            throw new InvalidFileTypeException($errorMsg);
        }
    }
	
    /**
     * @return FileLocation
     */
    public function getFileLocation()
    {
        return clone $this->location;
    }
}
