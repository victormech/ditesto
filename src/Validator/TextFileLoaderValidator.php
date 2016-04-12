<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto\Validator;


use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\ValueObject\FileLocation;

class TextFileLoaderValidator extends AbstractTextFileValidator
{
    /**
     * @var FileLocation
     */
    protected $location;

    /**
     * @param FileLocation $location
     */
    public function __construct(FileLocation $location)
    {
        $this->location = clone $location;
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
     * @return FileLocation
     */
    public function getFileLocation()
    {
        return clone $this->location;
    }
}
