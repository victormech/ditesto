<?php

namespace LazyEight\DiTesto\Interfaces;

interface FileInterface extends PrintableContentInterface
{
    /**
     * Returns the path of the file.
     * @return string
     */
    public function getPath():string;

    /**
     * Returns the raw content of the file.
     * @return string
     */
    public function getRawContent():string;

    /**
     * Sets the raw content of the file.
     * @param string $content
     * @return void
     */
    public function setRawContent(string $content);
}
