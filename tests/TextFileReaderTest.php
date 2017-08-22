<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
use LazyEight\DiTesto\TextFile;
use LazyEight\DiTesto\TextFileReader;
use PHPUnit\Framework\TestCase;

class TextFileReaderTest extends TestCase
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
     * @covers \LazyEight\DiTesto\TextFileReader::__construct
     * @uses \LazyEight\DiTesto\TextFileReader
     * @return \LazyEight\DiTesto\TextFileReader
     */
    public function testCanBeCreated()
    {
        $filename = $this->file;
        $instance = new TextFileReader($filename);
        $this->assertInstanceOf(TextFileReader::class, $instance);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileReader::readFile
     * @covers \LazyEight\DiTesto\TextFileReader::validate
     * @covers \LazyEight\DiTesto\TextFileReader::validatePath
     * @covers \LazyEight\DiTesto\TextFileReader::validateReadable
     * @covers \LazyEight\DiTesto\TextFileReader::validateType
     * @uses \LazyEight\DiTesto\TextFileReader
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\TextFileReader
     * @param \LazyEight\DiTesto\TextFileLoader
     */
    public function testCanBeLoaded(TextFileReader $loader)
    {
        $this->assertInstanceOf(TextFile::class, $loader->readFile());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileReader::readFile
     * @covers \LazyEight\DiTesto\TextFileReader::validate
     * @covers \LazyEight\DiTesto\TextFileReader::validatePath
     * @expectedException \LazyEight\DiTesto\Exceptions\IOException
     * @uses \LazyEight\DiTesto\TextFileReader
     */
    public function testCantBeLoaded()
    {
        $loader = new TextFileReader('');
        $this->expectException(IOException::class);
        $loader->readFile();
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileReader::readFile
     * @covers \LazyEight\DiTesto\TextFileReader::validate
     * @covers \LazyEight\DiTesto\TextFileReader::validatePath
     * @covers \LazyEight\DiTesto\TextFileReader::validateType
     * @expectedException \LazyEight\DiTesto\Exceptions\IOException
     */
    public function testInvalidType()
    {
        $instance = new TextFileReader($this->imageFile);
        $this->expectException(IOException::class);
        $instance->readFile();
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileReader::readFile
     * @covers \LazyEight\DiTesto\TextFileReader::validate
     * @covers \LazyEight\DiTesto\TextFileReader::validatePath
     * @covers \LazyEight\DiTesto\TextFileReader::validateReadable
     * @expectedException \LazyEight\DiTesto\Exceptions\IOException
     */
    public function testCantRead()
    {
        chmod($this->notReadable, 0000);

        $instance = new TextFileReader($this->notReadable);
        $this->expectException(IOException::class);
        $instance->readFile();
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileReader::readFile
     * @covers \LazyEight\DiTesto\TextFileReader::getPath
     * @uses \LazyEight\DiTesto\TextFileReader
     */
    public function testCanGetPath()
    {
        $loader = new TextFileReader($this->file);
        $this->assertEquals($this->file, $loader->getPath());
    }
}
