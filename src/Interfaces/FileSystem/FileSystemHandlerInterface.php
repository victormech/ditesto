<?php

namespace LazyEight\DiTesto\Interfaces\FileSystem;

interface FileSystemHandlerInterface
{
    /**
     * Checks whether a file or directory exists
     * @param string $path
     * @return bool
     */
    public function exists(string $path):bool;

    /**
     * Tells whether a file exists and is readable
     * @param string $path
     * @return bool
     */
    public function isReadable(string $path):bool;

    /**
     * Tells whether the filename is writable
     * @param string $path
     * @return bool
     */
    public function isWritable(string $path):bool;

    /**
     * Returns a parent directory's path
     * @param string $path
     * @return string
     */
    public function getPathName(string $path):string;

    /**
     * Returns trailing name component of path
     * @param string $path
     * @return string
     */
    public function getFilename(string $path):string;

    /**
     * Gets file size
     * @param string $path
     * @return int
     */
    public function getSize(string $path):int;

    /**
     * Detect MIME Content-type for a file
     * @param string $path
     * @return string
     */
    public function getType(string $path):string;

    /**
     * Reads entire file into a string
     * @param string $path
     * @return string
     */
    public function read(string $path):string;

    /**
     * Write a string to a file
     * @param string $path
     * @param string $content
     * @return mixed
     */
    public function write(string $path, string $content);
}
