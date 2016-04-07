<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto\ValueObject;


use LazyEight\BasicTypes\Interfaces\ValueObjectInterface;
use LazyEight\BasicTypes\Stringy;

abstract class AbstractFileContent implements ValueObjectInterface
{
    /*
     * @var Stringy
     */
    protected $content;

    /**
     * @param Stringy $content
     */
    public function __construct(Stringy $content)
    {
        $this->content = $content;
    }

    /**
     * @return Stringy
     */
    public function getValue()
    {
        return clone $this->content;
    }
	
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->content;
    }
	
}
