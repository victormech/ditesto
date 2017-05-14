<?php

namespace LazyEight\DiTesto\Validator;

use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\ValueObject\FileLocation;

/**
 * Class TextFileLoaderValidator
 * @package LazyEight\DiTesto\Validator
 */
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
    public function validate() : bool
    {
        $this->validateFileLocation();
        $this->validateFileContent();
        return true;
    }

    /**
     * @return FileLocation
     */
    public function getFileLocation() : FileLocation
    {
        return clone $this->location;
    }
}
