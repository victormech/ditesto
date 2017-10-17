<?php

namespace LazyEight\DiTesto\Interfaces\FileSystem;

interface FileSystemReaderInterface
{
    /**
     * Tells whether a file or path exists and is readable
     * @return bool
     */
    public function isReadable():bool;

    /**
     * Reads entire file into a string
     * @return string
     */
    public function read():string;
}
