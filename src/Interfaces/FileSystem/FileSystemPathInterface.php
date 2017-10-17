<?php

namespace LazyEight\DiTesto\Interfaces\FileSystem;

interface FileSystemPathInterface
{
    /**
     * Returns the raw path
     * @return string
     */
    public function rawPath():string;

    /**
     * Checks whether a file or directory exists
     * @return bool
     */
    public function exists():bool;

    /**
     * Tells whether a path is a directory
     * @return bool
     */
    public function isDirectory():bool;

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
}
