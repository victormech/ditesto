<?php

namespace LazyEight\DiTesto\ValueObject;

use LazyEight\BasicTypes\Interfaces\ValueObjectInterface;
use LazyEight\BasicTypes\JString;

class FileLocation implements ValueObjectInterface
{
    /**
     * @var string
     */
    private $location;
    
    /**
     * @param string $location
     */
    public function __construct(string $location)
    {
        $this->location = $location;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getFileDirectory()
    {
        $jString = new JString($this->location);
        return $jString->substring(0, $jString->lastIndexOf("/"));
    }

    /**
     * @return bool
     */
    public function isWritable()
    {
        return is_writable($this->location);
    }
}
