<?php

namespace Test\DiTesto;

use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\ValueObject\File;
use LazyEight\DiTesto\ValueObject\FileContent;
use LazyEight\DiTesto\ValueObject\FileLocation;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
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
        $location = new FileLocation($this->file);
        $content = new FileContent(file_get_contents($this->file));
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
        $location = new FileLocation($this->file);
        $this->assertEquals($location, $file->getLocation());
        $this->assertNotEquals($location->getValue(), $file->getLocation());
    }

    /**
     * @covers \LazyEight\DiTesto\ValueObject\File::getRawContent
     * @covers \LazyEight\DiTesto\ValueObject\FileContent::getValue
     * @uses \LazyEight\DiTesto\ValueObject\File
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\ValueObject\File
     * @param \LazyEight\DiTesto\ValueObject\File
     */
    public function testContentCanBeRetrieved(File $file)
    {
        $content = file_get_contents($this->file);
        $this->assertEquals($content, $file->getRawContent()->getValue());
        $this->assertNotEquals('ABC', $file->getRawContent()->getValue());
    }

    /**
     * @covers \LazyEight\DiTesto\ValueObject\File::__toString
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\ValueObject\File
     * @param \LazyEight\DiTesto\ValueObject\File
     */
    public function testToString(File $file)
    {
        $this->assertEquals($file->__toString(), file_get_contents($this->file));
    }
}
