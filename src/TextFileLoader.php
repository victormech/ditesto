<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto;


use LazyEight\DiTesto\ValueObject\File;
use LazyEight\DiTesto\ValueObject\FileContent;
use LazyEight\DiTesto\ValueObject\FileLocation;

class TextFileLoader
{
    /*
     * @var FileLocation
     */
    private $fileLocation;
    
    /**
     * @param FileLocation $fileLocation
     */
    public function __construct(FileLocation $fileLocation)
    {
        // TODO: Implement __construct method.
    }
	
    /**
     * @return File
     */
    public function loadFile()
    {
        // TODO: Implement loadFile method.
    }
	
    /**
     * @return FileContent
     */
    protected function loadFileFromOS()
    {
        // TODO: Implement loadFileFromOS method.
    }
	
    /**
     * @return File
     */
    protected function createFileObject()
    {
        // TODO: Implement createFileObject method.
    }
	
    /**
     * @return bool
     */
    protected function validateFileLocation()
    {
        // TODO: Implement validateFileLocation method.
    }
}
