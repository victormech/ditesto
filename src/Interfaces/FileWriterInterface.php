<?php

namespace LazyEight\DiTesto\Interfaces;

interface FileWriterInterface
{
    /**
     * @param WritableFileInterface $file
     * @return mixed
     */
    public function writeFile(WritableFileInterface $file);
}
