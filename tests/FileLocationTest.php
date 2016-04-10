<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 10/04/16
 * Time: 01:40
 */

namespace Test\DiTesto;


use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\ValueObject\FileLocation;

class FileLocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $file = './tests/files/urls.txt';

    /**
     * @covers \LazyEight\DiTesto\ValueObject\FileLocation::__construct
     * @uses \LazyEight\DiTesto\ValueObject\FileLocation
     * @return \LazyEight\DiTesto\ValueObject\FileLocation
     */
    public function testCanBeCreated()
    {
        $instance = new FileLocation(new Stringy($this->file));
        $this->assertInstanceOf(FileLocation::class, $instance);
        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\ValueObject\FileLocation::getValue
     * @uses \LazyEight\DiTesto\ValueObject\FileLocation
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\ValueObject\FileLocation
     * @param \LazyEight\DiTesto\ValueObject\FileLocation
     */
    public function testValueCanBeRetrieved(FileLocation $location)
    {
        $this->assertEquals($location->getValue()->getValue(), $this->file);
    }
}
