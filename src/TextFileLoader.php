<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto;


use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\Parser\TextContentParser;
use LazyEight\DiTesto\ValueObject\FileContent;
use LazyEight\DiTesto\ValueObject\FileLocation;
use LazyEight\DiTesto\ValueObject\TextFile\TextFile;

class TextFileLoader
{
    /*
     * @var FileLocation
     */
    private $fileLocation;

    /**
     * @var FileContent
     */
    private $rawContent;

    /**
     * @var TextFile
     */
    private $file;

    /**
     * @var TextFileValidator
     */
    private $validator;
    
    /**
     * @param FileLocation $fileLocation
     */
    public function __construct(FileLocation $fileLocation)
    {
        $this->fileLocation = $fileLocation;
    }

    /**
     * Load the file to memory
     *
     * @return TextFile The text file itself
     */
    public function loadFile()
    {
        $this->validateFile();
        $this->rawContent = $this->loadFileFromOS();
        $this->file = $this->createFileObject();
        return clone $this->file;
    }
	
    /**
     * @return FileContent
     */
    protected function loadFileFromOS()
    {
        return new FileContent(new Stringy(file_get_contents($this->fileLocation->getValue())));
    }
	
    /**
     * @return TextFile
     */
    protected function createFileObject()
    {
        $parser = new TextContentParser($this->rawContent);
        return new TextFile($this->fileLocation, $this->rawContent, $parser->parse());
    }
	
    /**
     * @throws InvalidFileLocationException
     * @throws InvalidFileTypeException
     * @return bool
     */
    protected function validateFile()
    {
        $this->getValidator()->validate();
    }

    /**
     * @return TextFileValidator
     */
    protected function getValidator()
    {
        if (!$this->validator) {
            $this->validator = new TextFileValidator($this->fileLocation);
        }
        return $this->validator;
    }
}
