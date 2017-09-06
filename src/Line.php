<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Interfaces\PrintableContentInterface;

class Line implements PrintableContentInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * Line constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function __toString()
    {
        return $this->getContent();
    }
}
