<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Interfaces\FileInterface;
use LazyEight\DiTesto\Interfaces\MeasurableFileInterface;
use LazyEight\DiTesto\Interfaces\ReadableFileInterface;
use LazyEight\DiTesto\Interfaces\TraversableFileInterface;
use LazyEight\DiTesto\Interfaces\TypableFileInterface;
use LazyEight\DiTesto\Interfaces\WritableFileInterface;
use Traversable;

class TextFile implements
    ReadableFileInterface,
    WritableFileInterface,
    MeasurableFileInterface,
    TypableFileInterface,
    FileInterface,
    TraversableFileInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var ArrayObjectLine
     */
    private $lines;

    /**
     * TextFile constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        $this->lines = new ArrayObjectLine();
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        return file_exists($this->path);
    }

    /**
     * @return bool
     */
    public function isReadable(): bool
    {
        return is_readable($this->path);
    }

    /**
     * @return bool
     */
    public function isWritable(): bool
    {
        return is_writable($this->path);
    }

    public function read()
    {
        $this->lines = new ArrayObjectLine(array_map(function ($line) {
            return new Line($line);
        }, explode(PHP_EOL, file_get_contents($this->path))));
    }

    public function write()
    {
        file_put_contents($this->path, $this->lines->getRawContent());
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return filesize($this->path);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return mime_content_type($this->path);
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return basename($this->path);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return dirname($this->path);
    }

    /**
     * @return string
     */
    public function getPathName(): string
    {
        return $this->path;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return $this->lines->getIterator();
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->lines->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->lines->offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->lines->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->lines->offsetUnset($offset);
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->lines->count();
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->lines->getRawContent();
    }
}
