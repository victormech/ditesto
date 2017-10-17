<?php

namespace LazyEight\DiTesto\Interfaces\FileSystem;

interface FileSystemWriterInterface
{
    /**
     * Tells whether the filename is writable
     * @return bool
     */
    public function isWritable():bool;

    /**
     * Write a string to a file
     * @param string $content
     * @return mixed
     */
    public function write(string $content);
}
