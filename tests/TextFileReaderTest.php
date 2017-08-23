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
     * @covers \LazyEight\DiTesto\TextFileReader::readFile
     * @uses \LazyEight\DiTesto\TextFileReader
     * @uses \LazyEight\DiTesto\TextFileReader
     * @param \LazyEight\DiTesto\TextFileLoader
     */
    public function testCanRead()
    {
        $textFile = new TextFile($this->file);
        (new TextFileReader())->readFile($textFile);

        $arrFile = explode(PHP_EOL, file_get_contents($this->file));
        $this->assertTrue(count($arrFile) === count($textFile));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileReader::readFile
     * @expectedException \LazyEight\DiTesto\Exceptions\IOException
     * @uses \LazyEight\DiTesto\TextFileReader
     */
    public function testCantBeLoaded()
    {
        $this->expectException(IOException::class);
        (new TextFileReader())->readFile(new TextFile(''));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileReader::readFile
     * @expectedException \LazyEight\DiTesto\Exceptions\IOException
     */
    public function testCantRead()
    {
        chmod($this->notReadable, 0000);

        $this->expectException(IOException::class);
        (new TextFileReader())->readFile(new TextFile($this->notReadable));
    }
}
