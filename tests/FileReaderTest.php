<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
use LazyEight\DiTesto\FileSystem\FileSystemHandler;
use LazyEight\DiTesto\TextFile;
use LazyEight\DiTesto\FileReader;
use PHPUnit\Framework\TestCase;

class FileReaderTest extends TestCase
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
     * @covers \LazyEight\DiTesto\FileReader::__construct
     * @covers \LazyEight\DiTesto\FileReader::readFile
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isReadable
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::read
     * @uses \LazyEight\DiTesto\FileReader
     * @uses \LazyEight\DiTesto\FileReader
     * @param \LazyEight\DiTesto\TextFileLoader
     */
    public function testCanRead()
    {
        $textFile = new TextFile($this->file);
        (new FileReader($textFile, new FileSystemHandler($textFile->getPath())))->readFile();

        $arrFile = explode(PHP_EOL, file_get_contents($this->file));
        $this->assertTrue(count($arrFile) === count($textFile));
    }

    /**
     * @covers \LazyEight\DiTesto\FileReader::readFile
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::isReadable
     * @covers \LazyEight\DiTesto\FileSystem\FileSystemHandler::read
     * @expectedException \LazyEight\DiTesto\Exceptions\IOException
     * @uses \LazyEight\DiTesto\FileReader
     */
    public function testCantBeLoaded()
    {
        $this->expectException(IOException::class);
        (new FileReader(new TextFile(''), new FileSystemHandler('')))->readFile();
    }

    /**
     * @covers \LazyEight\DiTesto\FileReader::readFile
     * @expectedException \LazyEight\DiTesto\Exceptions\IOException
     */
    public function testCantRead()
    {
        chmod($this->notReadable, 0000);

        $this->expectException(IOException::class);
        (new FileReader(new TextFile($this->notReadable), new FileSystemHandler($this->notReadable)))->readFile();
    }
}
