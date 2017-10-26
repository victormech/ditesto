<?php

namespace LazyEight\DiTesto\Collections;

class ArrayObjectLine extends \ArrayObject
{
    /**
     * @inheritDoc
     */
    public function getRawContent():string
    {
        return implode(PHP_EOL, $this->getArrayCopy());
    }
}
