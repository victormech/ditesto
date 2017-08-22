<?php

namespace LazyEight\DiTesto\Interfaces;

interface WritableFileInterface
{
    /**
     * @return mixed
     */
    public function write();

    /**
     * @return bool
     */
    public function isWritable():bool;
}
