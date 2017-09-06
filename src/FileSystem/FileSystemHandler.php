<?php

namespace LazyEight\DiTesto\FileSystem;

use LazyEight\DiTesto\Interfaces\FileSystem\FileSystemHandlerInterface;

class FileSystemHandler implements FileSystemHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function exists(string $path): bool
    {
        return file_exists($path);
    }

    /**
     * @inheritDoc
     */
    public function isReadable(string $path): bool
    {
        return is_readable($path);
    }

    /**
     * @inheritDoc
     */
    public function isWritable(string $path): bool
    {
        if (!$this->exists($path) && is_writable($this->getPathName($path))) {
            return true;
        }

        return is_writable($path);
    }

    /**
     * @inheritDoc
     */
    public function getPathName(string $path): string
    {
        return dirname($path);
    }

    /**
     * @inheritDoc
     */
    public function getFilename(string $path): string
    {
        return basename($path);
    }

    /**
     * @inheritDoc
     */
    public function getSize(string $path): int
    {
        return filesize($path);
    }

    /**
     * @inheritDoc
     */
    public function getType(string $path): string
    {
        return mime_content_type($path);
    }

    /**
     * @inheritDoc
     */
    public function read(string $path): string
    {
        return file_get_contents($path);
    }

    /**
     * @inheritDoc
     */
    public function write(string $path, string $content)
    {
        file_put_contents($path, $content);
    }
}
