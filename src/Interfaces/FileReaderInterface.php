<?php

namespace LazyEight\DiTesto\Interfaces;

interface FileReaderInterface
{
    /**
     * @return FileInterface
     */
    public function readFile():FileInterface;
}
