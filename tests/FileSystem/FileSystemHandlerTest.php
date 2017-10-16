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
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::__construct
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::exists
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testExists()
    {
        $this->assertTrue((new FileSystemHandler($this->file))->exists());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::__construct
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::exists
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testNotExists()
    {
        $this->assertFalse((new FileSystemHandler($this->notExistsFile))->exists());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isReadable
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testReadable()
    {
        $this->assertTrue((new FileSystemHandler($this->file))->isReadable());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isReadable
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testNotReadable()
    {
        $this->assertFalse((new FileSystemHandler($this->notReadable))->isReadable());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isWritable
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testWritable()
    {
        $this->assertTrue((new FileSystemHandler($this->file))->isWritable());
        $this->assertTrue((new FileSystemHandler($this->path))->isWritable());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isWritable
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testNotWritable()
    {
        $this->assertFalse((new FileSystemHandler($this->notReadable))->isWritable());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::pathName
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testGetPathName()
    {
        $this->assertEquals($this->path, (new FileSystemHandler($this->file))->pathName());
        $this->assertEquals($this->path, (new FileSystemHandler($this->imageFile))->pathName());
        $this->assertEquals($this->path, (new FileSystemHandler($this->notReadable))->pathName());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::pathName
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testCantGetPathName()
    {
        $this->assertNotEquals('', (new FileSystemHandler($this->file))->pathName());
        $this->assertNotEquals($this->file, (new FileSystemHandler($this->file))->pathName());
        $this->assertNotEquals($this->imageFile, (new FileSystemHandler($this->file))->pathName());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::filename
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testGetFileName()
    {
        $this->assertEquals($this->files[0], (new FileSystemHandler($this->file))->filename());
        $this->assertEquals($this->files[1], (new FileSystemHandler($this->imageFile))->filename());
        $this->assertEquals($this->files[2], (new FileSystemHandler($this->notReadable))->filename());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::filename
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testCantGetFileName()
    {
        $this->assertNotEquals($this->file, (new FileSystemHandler($this->file))->filename());
        $this->assertNotEquals('', (new FileSystemHandler($this->file))->filename());
        $this->assertNotEquals($this->file, (new FileSystemHandler($this->imageFile))->filename());
        $this->assertNotEquals('', (new FileSystemHandler($this->imageFile))->filename());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::size
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testGetSize()
    {
        $this->assertEquals($this->sizes[0], (new FileSystemHandler($this->file))->size());
        $this->assertEquals($this->sizes[1], (new FileSystemHandler($this->imageFile))->size());
        $this->assertEquals($this->sizes[2], (new FileSystemHandler($this->notReadable))->size());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::filename
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testCantGetSize()
    {
        $this->assertNotEquals($this->sizes[1], (new FileSystemHandler($this->file))->size());
        $this->assertNotEquals($this->sizes[0], (new FileSystemHandler($this->imageFile))->size());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::type
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testGetType()
    {
        $this->assertEquals($this->types[0], (new FileSystemHandler($this->file))->type());
        $this->assertEquals($this->types[1], (new FileSystemHandler($this->imageFile))->type());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::filename
     * @uses \LazyEight\DiTesto\FileSystem\FileSystemHandler
     */
    public function testCantGetType()
    {
        $this->assertNotEquals($this->types[1], (new FileSystemHandler($this->file))->type());
        $this->assertNotEquals($this->types[0], (new FileSystemHandler($this->imageFile))->type());
    }
}
