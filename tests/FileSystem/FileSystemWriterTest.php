<?php

namespace Test\DiTesto\FileSystem;

use LazyEight\DiTesto\FileSystem\Exceptions\FileSystemException;
use LazyEight\DiTesto\FileSystem\Exceptions\InvalidPathException;
use LazyEight\DiTesto\FileSystem\FileSystemHandler;
use LazyEight\DiTesto\FileSystem\FileSystemPath;
use LazyEight\DiTesto\FileSystem\FileSystemWriter;
use PHPUnit\Framework\TestCase;

class FileSystemWriterTest extends TestCase
{
    /**
     * @var string
     */
    protected $file = './tests/files/urls.txt';

    /**
     * @var string
     */
    protected $path = './tests/files';

    /**
     * @var string
     */
    protected $newFilename = 'newFilename.txt';

    /**
     * @var string
     */
    protected $notReadable = './tests/files/urls_not_readable.txt';

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::__construct
     * @uses \LazyEight\DiTesto\FileWriter
     */
    public function testCanContruct()
    {
        $newFilename = $this->path . '/' . $this->newFilename;
        $handler = new FileSystemWriter(new FileSystemPath($newFilename));

        $this->assertInstanceOf(FileSystemWriter::class, $handler);
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::__construct
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::write
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validate
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validateWritableFile
     * @uses \LazyEight\DiTesto\FileWriter
     */
    public function testWriteNewFile()
    {
        $content = 'TEST';
        $newFilename = $this->path . '/' . $this->newFilename;
        $handler = new FileSystemWriter(new FileSystemPath($newFilename));
        $handler->write($content);

        $this->assertFileExists($newFilename);
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::isWritable
     * @uses \LazyEight\DiTesto\FileWriter
     */
    public function testIsWriteable()
    {
        $newFilename = $this->path . '/' . $this->newFilename;

        $handler = new FileSystemWriter(new FileSystemPath($newFilename));
        $errorHandler = new FileSystemWriter(new FileSystemPath($this->notReadable));

        $this->assertTrue($handler->isWritable());
        $this->assertFalse($errorHandler->isWritable());
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validate
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validateIsDirectory
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::isWritablePath
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validatePathIsWritable
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validateWritableFile
     * @expectedException \LazyEight\DiTesto\FileSystem\Exceptions\FileSystemException
     */
    public function testCantWrite()
    {
        $notReadableHandler = new FileSystemWriter(new FileSystemPath($this->notReadable));
        $pathHandler = new FileSystemWriter(new FileSystemPath($this->path));

        $this->expectException(FileSystemException::class);
        $notReadableHandler->write('TEST');

        $this->expectException(FileSystemException::class);
        $pathHandler->write('TEST');
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validate
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validateIsDirectory
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::isWritablePath
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validatePathIsWritable
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validateWritableFile
     * @expectedException \LazyEight\DiTesto\FileSystem\Exceptions\InvalidPathException
     */
    public function testCantWriteDirectory()
    {
        $pathHandler = new FileSystemWriter(new FileSystemPath($this->path));

        $this->expectException(InvalidPathException::class);
        $pathHandler->write('TEST');
    }

    /**
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validate
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validateIsDirectory
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validatePathIsWritable
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::validateWritableFile
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemWriter::isWritablePath
     * @expectedException \LazyEight\DiTesto\FileSystem\Exceptions\InvalidPathException
     */
    public function testCantWriteNoPermission()
    {
        $path = $this->path . '/' . 'newPath';
        mkdir($path);
        chmod($path, 0555);

        $newFilename = $path . '/' . $this->newFilename;
        $handler = new FileSystemWriter(new FileSystemPath($newFilename));

        $this->expectException(FileSystemException::class);
        $handler->write('TEST');
    }

    /**
     * @inheritDoc
     */
    public static function tearDownAfterClass()
    {
        $file = './tests/files/newFilename.txt';
        $newFilePath = './tests/files/newPath';

        if (file_exists($file)) {
            unlink($file);
        }

        if (file_exists($newFilePath)) {
            rmdir($newFilePath);
        }

        parent::tearDownAfterClass(); // TODO: Change the autogenerated stub
    }
}
