<?php
/**
 * Created with PHP 5.6 generator
 * User: 
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto\ValueObject;


use LazyEight\BasicTypes\Stringy;

class FileContent extends AbstractFileContent
{
    /**
     * @param Stringy $content
     */
    public function __construct(Stringy $content)
    {
        $this->content = $content;
    }
}
