<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\Exceptions\IOException;
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
     * @covers \LazyEight\DiTesto\TextFile::exists
     * @uses \LazyEight\DiTesto\TextFile
     */
    public function testExists()
    {
        $this->assertTrue((new TextFile($this->file))->exists());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::exists
     * @uses \LazyEight\DiTesto\TextFile
     */
    public function testNotExists()
    {
        $this->assertFalse((new TextFile('abc.txt'))->exists());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::isReadable
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testIsReadable(TextFile $textFile)
    {
        $this->assertTrue($textFile->isReadable());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::isReadable
     * @uses \LazyEight\DiTesto\TextFile
     */
    public function testNotReadable()
    {
        chmod($this->notReadable, 0000);
        $this->assertFalse((new TextFile($this->notReadable))->isReadable());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::isWritable
     * @uses \LazyEight\DiTesto\TextFile
     */
    public function testIsWritable()
    {
        $instance = new TextFile($this->file);
        $this->assertFileIsWritable($this->file);
        $this->assertEquals(true, $instance->isWritable());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::isWritable
     * @uses \LazyEight\DiTesto\TextFile
     */
    public function testNewFileIsWritable()
    {
        $instance = new TextFile($this->newFilename);
        $this->assertFileIsWritable($this->file);
        $this->assertEquals(true, $instance->isWritable());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::isWritable
     * @uses \LazyEight\DiTesto\TextFile
     */
    public function testNotWritable()
    {
        $instance = new TextFile($this->notReadable);
        $this->assertFileNotIsWritable($this->notReadable);
        $this->assertEquals(false, $instance->isWritable());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getSize
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testGetSize(TextFile $textFile)
    {
        $this->assertEquals(121, $textFile->getSize());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getSize
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testGetSizeWrongSize(TextFile $textFile)
    {
        $this->assertNotEquals(0, $textFile->getSize());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getSize
     * @uses \LazyEight\DiTesto\TextFile
     */
    public function testGetSizeNotReadable()
    {
        $textFile = new TextFile($this->notReadable);
        $this->assertEquals(121, $textFile->getSize());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getType
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testGetType(TextFile $textFile)
    {
        $this->assertEquals('text/plain', $textFile->getType());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getType
     * @uses \LazyEight\DiTesto\TextFile
     */
    public function testGetWrongType()
    {
        $textFile = new TextFile($this->imageFile);
        $this->assertNotEquals('text/plain', $textFile->getType());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getFilename
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testGetFilename(TextFile $textFile)
    {
        $this->assertEquals(basename($this->file), $textFile->getFilename());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getFilename
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testGetWrongFilename(TextFile $textFile)
    {
        $this->assertNotEquals('', $textFile->getFilename());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getPath
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testGetPath(TextFile $textFile)
    {
        $this->assertEquals(dirname($this->file), $textFile->getPath());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getPath
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testGetWrongPath(TextFile $textFile)
    {
        $this->assertNotEquals('', $textFile->getPath());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getPathName
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testGetPathname(TextFile $textFile)
    {
        $this->assertEquals($this->file, $textFile->getPathName());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getPathName
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     */
    public function testGetWrongPathname(TextFile $textFile)
    {
        $this->assertNotEquals('', $textFile->getPathName());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::read
     * @covers \LazyEight\DiTesto\TextFile::__toString
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testCanBeCreated
     * @return \LazyEight\DiTesto\TextFile
     */
    public function testRead(TextFile $textFile)
    {
        $textFile->read();
        $this->assertEquals(file_get_contents($this->file), $textFile->__toString());

        return $textFile;
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::getIterator
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testRead
     */
    public function testGetIterator(TextFile $textFile)
    {
        $this->assertInstanceOf(\ArrayIterator::class, $textFile->getIterator());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetExists
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testRead
     */
    public function testOffsetExists(TextFile $textFile)
    {
        $this->assertTrue($textFile->offsetExists(0));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetExists
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testRead
     */
    public function testOffsetNotExists(TextFile $textFile)
    {
        $this->assertFalse($textFile->offsetExists(count($textFile) + 1));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::count
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testRead
     */
    public function testCount(TextFile $textFile)
    {
        $lines = explode(PHP_EOL, file_get_contents($this->file));
        $this->assertEquals(count($lines), $textFile->count());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetGet
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testRead
     */
    public function testOffsetGet(TextFile $textFile)
    {
        $lines = explode(PHP_EOL, file_get_contents($this->file));
        $this->assertEquals($lines[0], $textFile->offsetGet(0));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetSet
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testRead
     */
    public function testOffsetSet(TextFile $textFile)
    {
        $newLine = new Line('this is a new line');
        $textFile->offsetSet(0, $newLine);
        $this->assertEquals($newLine, $textFile->offsetGet(0));
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::write
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testRead
     */
    public function testWrite(TextFile $textFile)
    {
        $newFile = new TextFile($this->newFilename);
        $newFile[] = clone $textFile[0];
        $newFile->write();

        $this->assertTrue($newFile->exists());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFile::offsetUnset
     * @uses \LazyEight\DiTesto\TextFile
     * @depends testRead
     */
    public function testOffsetUnset(TextFile $textFile)
    {
        $textFile->offsetUnset(0);
        $this->assertEquals(3, $textFile->count());
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

        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}
