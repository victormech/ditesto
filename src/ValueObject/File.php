<?php

namespace LazyEight\DiTesto\ValueObject;

/**
 * Class File
 * @package LazyEight\DiTesto\ValueObject
 */
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
    public function getLocation() : FileLocation
    {
        return clone $this->location;
    }

    /**
     * @return FileContent Raw content of the file
     */
    public function getRawContent() : FileContent
    {
        return clone $this->content;
    }

    /**
     * @return bool
     */
    public function exists() : bool
    {
        return file_exists($this->location->getValue());
    }

    /**
     * @return bool
     */
    public function isWritable() : bool
    {
        return $this->location->isWritable();
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->getRawContent()->getValue()->getValue();
    }
}
