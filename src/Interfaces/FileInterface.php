<?php

namespace LazyEight\DiTesto\Interfaces;

interface FileInterface
{
    public function getFilename():string;
    public function getPath():string;
    public function getPathName():string;
}
