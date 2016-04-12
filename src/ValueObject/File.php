<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto\ValueObject;


class File
{
    /**
     * @var FileLocation
     */
    private $location;
    
    /**
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
    public function getRawContent()
    {
        return clone $this->content;
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->location->getValue());
    }

    /**
     * @return bool
     */
    public function isWritable()
    {
        return $this->location->isWritable();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getRawContent()->getValue()->getValue();
    }
}
