<?php

namespace LazyEight\DiTesto\Interfaces\TextFile;

interface TextFileContentInterface
{
    /**
     * Returns all the lines of the text file together.
     * @return string
     */
    public function getRawContent():string;
}
