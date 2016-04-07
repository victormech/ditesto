<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto\ValueObject;


use LazyEight\BasicTypes\Interfaces\ValueObjectInterface;
use LazyEight\BasicTypes\Stringy;

class FileType implements ValueObjectInterface
{

    /*
     * @var Stringy
     */
    private $description;
    
    /**
     * @param Stringy $description
     */
    public function __construct(Stringy $description)
    {
        $this->description = $description;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return clone $this->description;
    }
}
