<?php

namespace LazyEight\DiTesto\Interfaces;

interface ReadableFileInterface
{
    public function read();
    /**
     * @return bool
     */
    public function isReadable():bool;
}
