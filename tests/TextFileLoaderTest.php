<?php
/**
 * Created by PhpStorm.
 * User: Victor Ribeiro <victormech@gmail.com>
 * Date: 09/04/16
 */

namespace Test\DiTesto;


use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\TextFileLoader;
use LazyEight\DiTesto\ValueObject\FileLocation;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;

class TextFileLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $file = './tests/files/urls.txt';

    protected $imageFile = './tests/files/images.jpg';

    /**
     * @covers \LazyEight\DiTesto\TextFileLoader::__construct
     * @uses \LazyEight\DiTesto\TextFileLoader
     * @return \LazyEight\DiTesto\TextFileLoader
     */
    public function testCanBeCreated()
    {
        $filename = new Stringy($this->file);
        $instance = new TextFileLoader(new FileLocation($filename));
        $this->assertInstanceOf(TextFileLoader::class, $instance);
        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileLoader::loadFile
     * @uses \LazyEight\DiTesto\TextFileLoader
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\TextFileLoader
     * @param \LazyEight\DiTesto\TextFileLoader
     */
    public function testCanBeLoaded(TextFileLoader $loader)
    {
        $loader->loadFile();
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileLoader::loadFile
     * @expectedException \LazyEight\DiTesto\Exceptions\InvalidFileTypeException
     * @uses \LazyEight\DiTesto\TextFileLoader
     */
    public function testCantBeLoaded()
    {
        $textLoader = new TextFileLoader(new FileLocation(new Stringy($this->imageFile)));
        $this->expectException(InvalidFileTypeException::class);
        $textLoader->loadFile();
    }
}
