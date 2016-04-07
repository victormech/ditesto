<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto\ValueObject;


class File
{
    /*
     * @var FileLocation
     */
    private $location;
    
    /*
     * @var FileContent
     */
    private $content;
    
    /*
     * @var FileType
     */
    private $type;
    
    /**
     * @param FileLocation $location
     * @param FileContent $content
     * @param FileType $fileType
     */
    public function __construct(FileLocation $location, FileContent $content, FileType $fileType)
    {
        $this->location = $location;
        $this->content = $content;
        $this->type = $fileType;
    }
	
    /**
     * @return FileLocation
     */
    public function getLocation()
    {
        return clone $this->location;
    }
	
    /**
     * @return FileType
     */
    public function getType()
    {
        return clone $this->type;
    }
	
    /**
     * @return FileContent
     */
    public function getContent()
    {
        return clone $this->content;
    }
}
