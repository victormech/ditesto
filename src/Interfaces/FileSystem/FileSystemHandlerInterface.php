<?php

namespace LazyEight\DiTesto\Interfaces\FileSystem;

interface FileSystemHandlerInterface
{
    /**
     * Tells whether a file exists and is readable
     * @return bool
     */
    public function readable():bool;

    /**
     * Tells whether the filename is writable
     * @return bool
     */
    public function writable():bool;

    /**
     * Reads entire file into a string
     * @return string
     */
    public function read():string;

    /**
     * Write a string to a file
     * @param string $content
     * @return mixed
     */
    public function write(string $content);
}
