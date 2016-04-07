<?php
/**
 * Created with PHP 5.6 generator
 * User: Victor Ribeiro <victormech@gmail.com>
 * PHP 5.6 generator created by Victor MECH - April 2016
*/

namespace LazyEight\DiTesto\ValueObject;


class File implements ValueObjectInterface
{
    /*
     * @var FileLocation
     */
    private $location;
    
    /*
     * @var FileContent
     */
    private $content;
    
    /*
     * @var FileType
     */
    private $type;
    
    /**
     * @param FileLocation $location
     * @param FileContent $content
     * @param FileType $fileType
     */
    public function __construct(FileLocation $location, FileContent $content, FileType $fileType)
    {
        // TODO: Implement __construct method.
    }
	
    /**
     * @return FileLocation
     */
    public function getLocation()
    {
        // TODO: Implement getLocation method.
    }
	
    /**
     * @return FileType
     */
    public function getType()
    {
        // TODO: Implement getType method.
    }
	
    /**
     * @return FileContent
     */
    public function getContent()
    {
        // TODO: Implement getContent method.
    }
}
