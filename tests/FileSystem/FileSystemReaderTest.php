<?php

namespace Test\DiTesto\FileSystem;

use LazyEight\DiTesto\FileSystem\Exceptions\FileSystemException;
use LazyEight\DiTesto\FileSystem\FileSystemPath;
use LazyEight\DiTesto\FileSystem\FileSystemReader;
use PHPUnit\Framework\TestCase;
use LazyEight\DiTesto\FileSystem\Exceptions\InvalidPathException;

class FileSystemReaderTest extends TestCase
{
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
    protected $directory = './tests/files/';

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::__construct
     * @return FileSystemReader
     */
    public function testCanCreate()
    {
        $instance = new FileSystemReader(new FileSystemPath($this->file));
        $this->assertInstanceOf(FileSystemReader::class, $instance);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::read
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::validate
     * @param \LazyEight\DiTesto\TextFileLoader
     */
    public function testCanRead()
    {
        $fileReader = new FileSystemReader(new FileSystemPath($this->file));
        $fileContent = $fileReader->read();
        $this->assertEquals(file_get_contents($this->file), $fileContent);
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::read
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::validate
     * @expectedException \LazyEight\DiTesto\FileSystem\Exceptions\FileSystemException
     * @uses \LazyEight\DiTesto\FileReader
     */
    public function testCantBeLoaded()
    {
        $fileReader = new FileSystemReader(new FileSystemPath(''));
        $this->expectException(FileSystemException::class);
        $fileReader->read();
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::read
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::validate
     * @expectedException \LazyEight\DiTesto\FileSystem\Exceptions\InvalidPathException
     * @uses \LazyEight\DiTesto\FileReader
     */
    public function testCantLoadDirectory()
    {
        $fileReader = new FileSystemReader(new FileSystemPath($this->directory));
        $this->expectException(InvalidPathException::class);
        $fileReader->read();
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::read
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::validate
     * @expectedException \LazyEight\DiTesto\FileSystem\Exceptions\FileSystemException
     */
    public function testCantRead()
    {
        chmod($this->notReadable, 0000);
        $this->expectException(FileSystemException::class);
        (new FileSystemReader(new FileSystemPath($this->notReadable)))->read();
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemReader::isReadable
     */
    public function testIsReadable()
    {
        $fileReader = new FileSystemReader(new FileSystemPath($this->file));
        $this->assertTrue($fileReader->isReadable());

        chmod($this->notReadable, 0000);
        $fileReader = new FileSystemReader(new FileSystemPath($this->notReadable));
        $this->assertFalse($fileReader->isReadable());
    }
}
