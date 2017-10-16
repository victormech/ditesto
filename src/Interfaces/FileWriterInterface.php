<?php

namespace LazyEight\DiTesto\Interfaces;

interface FileWriterInterface
{
    /**
     * Write a file to a file system.
     * @return void
     */
    public function writeFile();
}
