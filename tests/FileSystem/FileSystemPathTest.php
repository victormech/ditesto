<?php

namespace Test\DiTesto\FileSystem;

use LazyEight\DiTesto\FileSystem\FileSystemPath;
use PHPUnit\Framework\TestCase;

class FileSystemPathTest extends TestCase
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
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::__construct
     * @return FileSystemPath
     */
    public function testCanBeCreated()
    {
        $instance = new FileSystemPath($this->file);
        $this->assertInstanceOf(FileSystemPath::class, $instance);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::__construct
     */
    public function testCantBeCreated()
    {
        $this->expectException(\TypeError::class);
        (new FileSystemPath(null));
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::rawPath
     * @depends testCanBeCreated
     */
    public function testCanRetrieveRawPath(FileSystemPath $systemPath)
    {
        $this->assertEquals($this->file, $systemPath->rawPath());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::rawPath
     * @depends testCanBeCreated
     */
    public function testCantRetrieveRawPath(FileSystemPath $systemPath)
    {
        $this->assertNotEquals($this->imageFile, $systemPath->rawPath());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::pathName
     * @depends testCanBeCreated
     */
    public function testCanRetrievePathname(FileSystemPath $systemPath)
    {
        $this->assertEquals($this->path, $systemPath->pathName());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::pathName
     * @depends testCanBeCreated
     */
    public function testCantRetrievePathname(FileSystemPath $systemPath)
    {
        $this->assertNotEquals($this->imageFile, $systemPath->pathName());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::filename
     * @depends testCanBeCreated
     */
    public function testCanRetrieveFilename(FileSystemPath $systemPath)
    {
        $this->assertEquals($this->files[0], $systemPath->filename());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::filename
     * @depends testCanBeCreated
     */
    public function testCantRetrieveFilename(FileSystemPath $systemPath)
    {
        $this->assertNotEquals($this->files[1], $systemPath->filename());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::size
     * @depends testCanBeCreated
     */
    public function testCanRetrieveSize(FileSystemPath $systemPath)
    {
        $this->assertEquals($this->sizes[0], $systemPath->size());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::size
     * @depends testCanBeCreated
     */
    public function testCantRetrieveSize(FileSystemPath $systemPath)
    {
        $this->assertNotEquals($this->sizes[1], $systemPath->size());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::type
     * @depends testCanBeCreated
     */
    public function testCanRetrieveType(FileSystemPath $systemPath)
    {
        $this->assertEquals($this->types[0], $systemPath->type());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::type
     * @depends testCanBeCreated
     */
    public function testCantRetrieveType(FileSystemPath $systemPath)
    {
        $this->assertNotEquals($this->types[1], $systemPath->type());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::exists
     * @depends testCanBeCreated
     */
    public function testExists(FileSystemPath $systemPath)
    {
        $this->assertTrue($systemPath->exists());
        $this->assertFileExists($this->file, $systemPath->rawPath());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::exists
     */
    public function testNotExists()
    {
        $path = new FileSystemPath($this->notExistsFile);
        $this->assertFalse($path->exists());
        $this->assertFileNotExists($this->notExistsFile, $path->rawPath());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemPath::isDirectory
     */
    public function testIsDirectory()
    {
        $this->assertTrue((new FileSystemPath($this->path))->isDirectory());
        $this->assertFalse((new FileSystemPath($this->file))->isDirectory());
    }
}
