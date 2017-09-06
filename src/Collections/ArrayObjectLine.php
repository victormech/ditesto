<?php

namespace LazyEight\DiTesto\Collections;

use LazyEight\DiTesto\Interfaces\TextFile\TextFileContentInterface;

class ArrayObjectLine extends \ArrayObject implements TextFileContentInterface
{
    /**
     * @inheritDoc
     */
    public function getRawContent():string
    {
        return implode(PHP_EOL, $this->getArrayCopy());
    }
}