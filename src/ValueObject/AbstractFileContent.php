<?php

namespace LazyEight\DiTesto\ValueObject;

use LazyEight\BasicTypes\Interfaces\ValueObjectInterface;

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
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->content;
    }
}
