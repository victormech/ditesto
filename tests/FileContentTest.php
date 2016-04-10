<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 10/04/16
 * Time: 02:04
 */

namespace Test\DiTesto;


use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\ValueObject\FileContent;

class FileContentTest extends \PHPUnit_Framework_TestCase
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
        $instance = new FileContent(new Stringy(file_get_contents($this->file)));
        $this->assertInstanceOf(FileContent::class, $instance);
        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\ValueObject\FileContent::getValue
     * @uses \LazyEight\DiTesto\ValueObject\FileContent
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\ValueObject\FileContent
     * @param \LazyEight\DiTesto\ValueObject\FileContent
     */
    public function testValueCanBeRetrieved(FileContent $content)
    {
        $this->assertEquals($content->getValue()->getValue(), new Stringy(file_get_contents($this->file)));
    }
}
