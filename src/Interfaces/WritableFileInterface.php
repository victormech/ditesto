<?php

namespace LazyEight\DiTesto\Interfaces;

interface WritableFileInterface extends WritableInterface
{
    /**
     * @return bool
     */
    public function isWritable():bool;
}
