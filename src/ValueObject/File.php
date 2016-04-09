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

    /**
     * @param FileLocation $location
     * @param FileContent $content
     */
    public function __construct(FileLocation $location, FileContent $content)
    {
        $this->location = $location;
        $this->content = $content;
    }
	
    /**
     * @return FileLocation The location of the file on disk
     */
    public function getLocation()
    {
        return clone $this->location;
    }

    /**
     * @return FileContent Raw content of the file
     */
    public function getContent()
    {
        return clone $this->content;
    }
}
