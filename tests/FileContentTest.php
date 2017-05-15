<?php

namespace Test\DiTesto;

use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\ValueObject\FileContent;
use PHPUnit\Framework\TestCase;

class FileContentTest extends TestCase
{
    /**
     * @var string
     */
    protected $file = './tests/files/urls.txt';

    /**
     * @covers \LazyEight\DiTesto\ValueObject\FileContent::__construct
     * @uses \LazyEight\DiTesto\ValueObject\FileContent
     * @return \LazyEight\DiTesto\ValueObject\FileContent
     */
    public function testCanBeCreated()
    {
        $instance = new FileContent(file_get_contents($this->file));
        $this->assertInstanceOf(FileContent::class, $instance);
        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\ValueObject\FileContent::getValue
     * @covers \LazyEight\DiTesto\ValueObject\AbstractFileContent::getValue
     * @uses \LazyEight\DiTesto\ValueObject\FileContent
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\ValueObject\FileContent
     * @param \LazyEight\DiTesto\ValueObject\FileContent
     */
    public function testValueCanBeRetrieved(FileContent $content)
    {
        $this->assertEquals($content->getValue(), file_get_contents($this->file));
    }

    /**
     * @covers \LazyEight\DiTesto\ValueObject\FileContent::__toString
     * @covers \LazyEight\DiTesto\ValueObject\AbstractFileContent::__toString
     * @uses \LazyEight\DiTesto\ValueObject\FileContent
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\ValueObject\FileContent
     * @param \LazyEight\DiTesto\ValueObject\FileContent
     */
    public function testToString(FileContent $content)
    {
        $this->assertEquals($content->__toString(), file_get_contents($this->file));
    }
}
