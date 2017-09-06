<?php

namespace Test\DiTesto\FileSystem;

use LazyEight\DiTesto\FileSystem\FileSystemHandler;
use PHPUnit\Framework\TestCase;

class FileSystemHandlerTest extends TestCase
{
    /**
     * @var string
     */
    protected $path = './tests/files';

    /**
     * @var array
     */
    protected $files = ['urls.txt', 'images.jpg', 'urls_not_readable.txt'];

    /**
     * @var array
     */
    protected $sizes = [121, 8402, 121];

    /**
     * @var array
     */
    protected $types = ['text/plain', 'image/jpeg', 'text/plain'];

    /**
     * @var string
     */
    protected $file = './tests/files/urls.txt';

    /**
     * @var string
     */
    protected $imageFile = './tests/files/images.jpg';

    /**
     * @var string
     */
    protected $notReadable = './tests/files/urls_not_readable.txt';

    /**
     * @var string
     */
    protected $notExistsFile = './tests/files/newFilename.txt';

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::exists
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testExists()
    {
        $this->assertTrue((new FileSystemHandler())->exists($this->file));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::exists
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testNotExists()
    {
        $this->assertFalse((new FileSystemHandler())->exists($this->notExistsFile));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isReadable
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testReadable()
    {
        $this->assertTrue((new FileSystemHandler())->isReadable($this->file));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isReadable
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testNotReadable()
    {
        $this->assertFalse((new FileSystemHandler())->isReadable($this->notReadable));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isWritable
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testWritable()
    {
        $this->assertTrue((new FileSystemHandler())->isWritable($this->file));
        $this->assertTrue((new FileSystemHandler())->isWritable($this->path));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isWritable
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testNotWritable()
    {
        $this->assertFalse((new FileSystemHandler())->isWritable($this->notReadable));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::getPathName
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testGetPathName()
    {
        $this->assertEquals($this->path, (new FileSystemHandler())->getPathName($this->file));
        $this->assertEquals($this->path, (new FileSystemHandler())->getPathName($this->imageFile));
        $this->assertEquals($this->path, (new FileSystemHandler())->getPathName($this->notReadable));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::getPathName
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testCantGetPathName()
    {
        $this->assertNotEquals('', (new FileSystemHandler())->getPathName($this->file));
        $this->assertNotEquals($this->file, (new FileSystemHandler())->getPathName($this->file));
        $this->assertNotEquals($this->imageFile, (new FileSystemHandler())->getPathName($this->file));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::getFilename
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testGetFileName()
    {
        $this->assertEquals($this->files[0], (new FileSystemHandler())->getFilename($this->file));
        $this->assertEquals($this->files[1], (new FileSystemHandler())->getFilename($this->imageFile));
        $this->assertEquals($this->files[2], (new FileSystemHandler())->getFilename($this->notReadable));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::getFilename
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testCantGetFileName()
    {
        $this->assertNotEquals($this->file, (new FileSystemHandler())->getFilename($this->file));
        $this->assertNotEquals('', (new FileSystemHandler())->getFilename($this->file));
        $this->assertNotEquals($this->file, (new FileSystemHandler())->getFilename($this->imageFile));
        $this->assertNotEquals('', (new FileSystemHandler())->getFilename($this->imageFile));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::getSize
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testGetSize()
    {
        $this->assertEquals($this->sizes[0], (new FileSystemHandler())->getSize($this->file));
        $this->assertEquals($this->sizes[1], (new FileSystemHandler())->getSize($this->imageFile));
        $this->assertEquals($this->sizes[2], (new FileSystemHandler())->getSize($this->notReadable));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::getFilename
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testCantGetSize()
    {
        $this->assertNotEquals($this->sizes[1], (new FileSystemHandler())->getSize($this->file));
        $this->assertNotEquals($this->sizes[0], (new FileSystemHandler())->getSize($this->imageFile));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::getType
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testGetType()
    {
        $this->assertEquals($this->types[0], (new FileSystemHandler())->getType($this->file));
        $this->assertEquals($this->types[1], (new FileSystemHandler())->getType($this->imageFile));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::getFilename
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testCantGetType()
    {
        $this->assertNotEquals($this->types[1], (new FileSystemHandler())->getType($this->file));
        $this->assertNotEquals($this->types[0], (new FileSystemHandler())->getType($this->imageFile));
    }
}
