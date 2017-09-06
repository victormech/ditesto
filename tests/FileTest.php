<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    /**
     * @var string
     */
    protected $file = './tests/files/urls.txt';

    /**
     * @covers \LazyEight\DiTesto\File::__construct
     * @uses \LazyEight\DiTesto\File
     * @return File
     */
    public function testCanBeCreated()
    {
        $instance = new File($this->file);
        $this->assertInstanceOf(File::class, $instance);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\File::__construct
     * @covers \LazyEight\DiTesto\File::getRawContent
     * @uses \LazyEight\DiTesto\File
     */
    public function testCanBeInitWithContent()
    {
        $content = file_get_contents($this->file);
        $instance = new File($this->file, $content);

        $this->assertInstanceOf(File::class, $instance);
        $this->assertEquals($content, $instance->getRawContent());

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\File::getPath
     * @uses \LazyEight\DiTesto\File
     * @depends testCanBeCreated
     * @param File $file
     */
    public function testGetPath(File $file)
    {
        $this->assertEquals($this->file, $file->getPath());
    }

    /**
     * @covers \LazyEight\DiTesto\File::getPath
     * @uses \LazyEight\DiTesto\File
     * @depends testCanBeCreated
     * @param File $file
     */
    public function testCantGetPath(File $file)
    {
        $this->assertNotEquals('', $file->getPath());
    }

    /**
     * @covers \LazyEight\DiTesto\File::getRawContent
     * @uses \LazyEight\DiTesto\File
     * @depends testCanBeInitWithContent
     * @param File $file
     */
    public function testGetRawContent(File $file)
    {
        $content = file_get_contents($this->file);
        $this->assertEquals($content, $file->getRawContent());
    }

    /**
     * @covers \LazyEight\DiTesto\File::getRawContent
     * @uses \LazyEight\DiTesto\File
     * @depends testCanBeInitWithContent
     * @param File $file
     */
    public function testCantGetRawContent(File $file)
    {
        $this->assertNotEquals('', $file->getRawContent());
    }

    /**
     * @covers \LazyEight\DiTesto\File::setRawContent
     * @covers \LazyEight\DiTesto\File::getRawContent
     * @uses \LazyEight\DiTesto\File
     * @depends testCanBeCreated
     * @param File $file
     */
    public function testSetRawContent(File $file)
    {
        $file->setRawContent($content = file_get_contents($this->file));
        $this->assertEquals($content, $file->getRawContent());
    }

    /**
     * @covers \LazyEight\DiTesto\File::__toString
     * @uses \LazyEight\DiTesto\File
     * @depends testCanBeInitWithContent
     * @param File $file
     */
    public function testToString(File $file)
    {
        $content = file_get_contents($this->file);
        $this->assertEquals($content, $file->__toString());
    }
}
