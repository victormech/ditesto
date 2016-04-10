<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 10/04/16
 * Time: 02:08
 */

namespace Test\DiTesto;


use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\ValueObject\File;
use LazyEight\DiTesto\ValueObject\FileContent;
use LazyEight\DiTesto\ValueObject\FileLocation;

class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $file = './tests/files/urls.txt';

    /**
     * @covers \LazyEight\DiTesto\ValueObject\File::__construct
     * @covers \LazyEight\DiTesto\ValueObject\FileLocation::__construct
     * @covers \LazyEight\DiTesto\ValueObject\FileContent::__construct
     * @uses \LazyEight\DiTesto\ValueObject\File
     * @return \LazyEight\DiTesto\ValueObject\File
     */
    public function testCanBeCreated()
    {
        $location = new FileLocation(new Stringy($this->file));
        $content = new FileContent(new Stringy(file_get_contents($this->file)));
        $instance = new File($location, $content);
        $this->assertInstanceOf(File::class, $instance);
        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\ValueObject\File::getLocation
     * @covers \LazyEight\DiTesto\ValueObject\FileLocation::getValue
     * @uses \LazyEight\DiTesto\ValueObject\File
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\ValueObject\File
     * @param \LazyEight\DiTesto\ValueObject\File
     */
    public function testLocationCanBeRetrieved(File $file)
    {
        $location = new FileLocation(new Stringy($this->file));
        $this->assertEquals($location, $file->getLocation());
        $this->assertNotEquals($location->getValue(), $file->getLocation());
    }

    /**
     * @covers \LazyEight\DiTesto\ValueObject\File::getContent
     * @covers \LazyEight\DiTesto\ValueObject\FileContent::getValue
     * @uses \LazyEight\DiTesto\ValueObject\File
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\ValueObject\File
     * @param \LazyEight\DiTesto\ValueObject\File
     */
    public function testContentCanBeRetrieved(File $file)
    {
        $content = new FileContent(new Stringy(file_get_contents($this->file)));
        $this->assertEquals($content, $file->getContent());
        $this->assertNotEquals($content->getValue(), $file->getContent());
    }
}
