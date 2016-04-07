<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto\ValueObject\TextFile;


use LazyEight\DiTesto\ValueObject\File;

class TextFile extends File
{
    /*
     * @var array
     */
    private $lines;
    
    /**
     * @return array
     */
    public function lines()
    {
        // TODO: Implement getLines method.
    }
	
    /**
     * @param int $index
     * @return Line
     */
    public function lineAt($index)
    {
        // TODO: Implement getLineAt method.
    }
	
    /**
     * @return Line
     */
    public function firstLine()
    {
        // TODO: Implement getFirstLine method.
    }
	
    /**
     * @return Line
     */
    public function lastLine()
    {
        // TODO: Implement getLastLine method.
    }

    /**
     * @return int
     */
    public function count()
    {
        // TODO: Implement getLastLine method.
    }
}
