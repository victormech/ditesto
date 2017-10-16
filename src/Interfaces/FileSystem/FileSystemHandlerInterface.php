<?php

namespace LazyEight\DiTesto\Interfaces\FileSystem;

interface FileSystemHandlerInterface
{
    /**
     * Checks whether a file or directory exists
     * @return bool
     */
    public function exists():bool;

    /**
     * Tells whether a file exists and is readable
     * @return bool
     */
    public function isReadable():bool;

    /**
     * Tells whether the filename is writable
     * @return bool
     */
    public function isWritable():bool;

    /**
     * Returns a parent directory's path
     * @return string
     */
    public function pathName():string;

    /**
     * Returns trailing name component of path
     * @return string
     */
    public function filename():string;

    /**
     * Gets file size
     * @return int
     */
    public function size():int;

    /**
     * Detect MIME Content-type for a file
     * @return string
     */
    public function type():string;

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
