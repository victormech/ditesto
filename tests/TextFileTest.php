<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\Exceptions\FileSystemException;
use LazyEight\DiTesto\Line;
use LazyEight\DiTesto\TextFile;
use PHPUnit\Framework\TestCase;

class TextFileTest extends TestCase
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
    protected $newFilename = './tests/files/new_file.txt';


    /**
     * @covers \LazyEight\DiTesto\TextFile::__construct
     * @uses \LazyEight\DiTesto\TextFile
     * @return \LazyEight\DiTesto\TextFile
     */
    public function testCanBeCreated()
    {
        $instance = new TextFile($this->file);
        $this->assertInstanceOf(TextFile::class, $instance);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::__construct
     * @covers \LazyEight\DiTesto\TextFile::readLines
     * @uses \LazyEight\DiTesto\TextFile
     * @return \LazyEight\DiTesto\TextFile
     */
    public function testCanBeCreatedWithContent()
    {
        $instance = new TextFile($this->file, file_get_contents($this->file));
        $this->assertInstanceOf(TextFile::class, $instance);
        $this->assertEquals(file_get_contents($this->file), $instance->getRawContent());

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getRawContent
     * @uses \LazyEight\DiTesto\AbstractFile
     * @depends testCanBeCreatedWithContent
     * @param TextFile $file
     */
    public function testGetRawContent(TextFile $file)
    {
        $content = file_get_contents($this->file);
        $this->assertEquals($content, $file->getRawContent());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getRawContent
     * @uses \LazyEight\DiTesto\AbstractFile
     * @depends testCanBeCreatedWithContent
     * @param TextFile $file
     */
    public function testCantGetRawContent(TextFile $file)
    {
        $this->assertNotEquals('', $file->getRawContent());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::setRawContent
     * @covers \LazyEight\DiTesto\TextFile::readLines
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testSetRawContent(TextFile $textFile)
    {
        $textFile->setRawContent(file_get_contents($this->file));
        $this->assertEquals(file_get_contents($this->file), $textFile->getRawContent());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::setRawContent
     * @covers \LazyEight\DiTesto\TextFile::readLines
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testSetEmptyRawContent(TextFile $textFile)
    {
        $textFile->setRawContent('');
        $this->assertNotEquals(file_get_contents($this->file), $textFile->getRawContent());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getIterator
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreatedWithContent
     */
    public function testGetIterator(TextFile $textFile)
    {
        $this->assertInstanceOf(\ArrayIterator::class, $textFile->getIterator());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetExists
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreatedWithContent
     */
    public function testOffsetExists(TextFile $textFile)
    {
        $this->assertTrue($textFile->offsetExists(0));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetExists
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreatedWithContent
     */
    public function testOffsetNotExists(TextFile $textFile)
    {
        $this->assertFalse($textFile->offsetExists(count($textFile) + 1));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::count
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreatedWithContent
     */
    public function testCount(TextFile $textFile)
    {
        $lines = explode(PHP_EOL, file_get_contents($this->file));
        $this->assertEquals(count($lines), $textFile->count());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetGet
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreatedWithContent
     */
    public function testOffsetGet(TextFile $textFile)
    {
        $lines = explode(PHP_EOL, file_get_contents($this->file));
        $this->assertEquals($lines[0], $textFile->offsetGet(0));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetSet
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreatedWithContent
     */
    public function testOffsetSet(TextFile $textFile)
    {
        $newLine = new Line('this is a new line');
        $textFile->offsetSet(0, $newLine);
        $this->assertEquals($newLine, $textFile->offsetGet(0));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetUnset
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreatedWithContent
     */
    public function testOffsetUnset(TextFile $textFile)
    {
        $textFile->offsetUnset(0);
        $this->assertEquals(3, $textFile->count());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::__toString
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testToString(TextFile $textFile)
    {
        $textFile->setRawContent(file_get_contents($this->file));
        $this->assertEquals(file_get_contents($this->file), $textFile->__toString());
    }

    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        chmod($this->notReadable, 0555);

        if (file_exists('./tests/files/new_file.txt')) {
            unlink('./tests/files/new_file.txt');
        }

        parent::tearDown();
    }
}
