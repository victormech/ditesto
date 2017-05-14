<?php

namespace LazyEight\DiTesto\ValueObject;

use LazyEight\BasicTypes\Interfaces\ValueObjectInterface;
use LazyEight\BasicTypes\Stringy;

/**
 * Class AbstractFileContent
 * @package LazyEight\DiTesto\ValueObject
 */
abstract class AbstractFileContent implements ValueObjectInterface
{
    /*
     * @var ValueObjectInterface
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
     * @return Stringy Raw content
     */
    public function getValue() : Stringy
    {
        return clone $this->content;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->content->getValue();
    }

}
