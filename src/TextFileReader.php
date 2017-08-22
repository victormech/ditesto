<?php

namespace LazyEight\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
use LazyEight\DiTesto\Interfaces\FileInterface;
use LazyEight\DiTesto\Interfaces\FileReaderInterface;

class TextFileReader implements FileReaderInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * TextFileReader constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function readFile():FileInterface
    {
        $this->valid($this->getPath());

        $textFile = new TextFile($this->getPath());
        $textFile->read();

        return $textFile;
    }

    /**
     * @return string
     */
    public function getPath():string
    {
        return $this->path;
    }

    private function valid(string $path)
    {
        $this->validatePath($path);
        $this->validateReadable($path);
        $this->validateType($path);
    }

    private function validatePath(string $path)
    {
        if (empty($path)) {
            throw new IOException('Invalid path.');
        }
    }

    private function validateType(string $path)
    {
        if ('text/plain' !== mime_content_type($path)) {
            throw new IOException('Invalid mime type. Only text/plain type is allowed.');
        }
    }

    private function validateReadable(string $path)
    {
        if (!(new TextFile($path))->isReadable()) {
            throw new IOException("Can't read the file");
        }
    }
}
