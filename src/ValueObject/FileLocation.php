<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto\ValueObject;


use LazyEight\BasicTypes\Interfaces\ValueObjectInterface;
use LazyEight\BasicTypes\Stringy;

class FileLocation implements ValueObjectInterface
{
    /**
     * @var Stringy
     */
    private $location;
    
    /**
     * @param Stringy $location
     */
    public function __construct(Stringy $location)
    {
        $this->location = $location;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return clone $this->location;
    }

    /**
     * @return Stringy
     */
    public function getFileDirectory()
    {
        return $this->location->substring(0, $this->location->lastIndexOf("/"));
    }

    /**
     * @return bool
     */
    public function isWritable()
    {
        return is_writable($this->location->getValue());
    }
}
