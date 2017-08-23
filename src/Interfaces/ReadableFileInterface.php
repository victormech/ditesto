<?php

namespace LazyEight\DiTesto\Interfaces;

interface ReadableFileInterface extends ReadableInterface
{
    /**
     * @return bool
     */
    public function isReadable():bool;
}
