<?php

namespace LazyEight\DiTesto;

use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\Parser\TextContentParser;
use LazyEight\DiTesto\Validator\TextFileLoaderValidator;
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
     * @param FileLocation $fileLocation
     */
    public function __construct(FileLocation $fileLocation)
    {
        $this->fileLocation = $fileLocation;
    }

    /**
     * Load the file to memory
     *
     * @throws InvalidFileLocationException
     * @throws InvalidFileTypeException
     * @return TextFile The text file itself
     */
    public function loadFile() : TextFile
    {
        $this->validateFile();
        $this->rawContent = $this->loadFileFromDisk();
        $this->file = $this->buildFileObject();
        return clone $this->file;
    }
	
    /**
     * @return FileContent
     */
    protected function loadFileFromDisk() : FileContent
    {
        return new FileContent(new Stringy(file_get_contents($this->fileLocation->getValue())));
    }
	
    /**
     * @return TextFile
     */
    protected function buildFileObject() : TextFile
    {
        $parser = new TextContentParser($this->rawContent);
        return new TextFile($this->fileLocation, $this->rawContent, $parser->parse());
    }
	
    /**
     * @throws InvalidFileLocationException
     * @throws InvalidFileTypeException
     * @return bool
     */
    protected function validateFile() : bool
    {
        return (new TextFileLoaderValidator($this->fileLocation))->validate();
    }
}
