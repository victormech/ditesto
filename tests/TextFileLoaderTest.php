<?php
/**
 * Created by PhpStorm.
 * User: Victor Ribeiro <victormech@gmail.com>
 * Date: 09/04/16
 */

namespace Test\DiTesto;


use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\TextFileLoader;
use LazyEight\DiTesto\ValueObject\FileLocation;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\ValueObject\TextFile\TextFile;

class TextFileLoaderTest extends \PHPUnit_Framework_TestCase
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
     * @covers \LazyEight\DiTesto\TextFileLoader::validateFile
     * @covers \LazyEight\DiTesto\TextFileLoader::loadFileFromOS
     * @covers \LazyEight\DiTesto\TextFileLoader::createFileObject
     * @uses \LazyEight\DiTesto\TextFileLoader
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\TextFileLoader
     * @param \LazyEight\DiTesto\TextFileLoader
     */
    public function testCanBeLoaded(TextFileLoader $loader)
    {
        $this->assertInstanceOf(TextFile::class, $loader->loadFile());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileLoader::loadFile
     * @covers \LazyEight\DiTesto\TextFileLoader::validateFile
     * @covers \LazyEight\DiTesto\TextFileLoader::loadFileFromOS
     * @covers \LazyEight\DiTesto\TextFileLoader::createFileObject
     * @expectedException \LazyEight\DiTesto\Exceptions\InvalidFileTypeException
     * @uses \LazyEight\DiTesto\TextFileLoader
     */
    public function testCantBeLoaded()
    {
        $textLoader = new TextFileLoader(new FileLocation(new Stringy($this->imageFile)));
        $this->expectException(InvalidFileTypeException::class);
        $textLoader->loadFile();
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileLoader::loadFile
     * @covers \LazyEight\DiTesto\TextFileLoader::validateFile
     * @expectedException \LazyEight\DiTesto\Exceptions\InvalidFileLocationException
     * @uses \LazyEight\DiTesto\TextFileLoader
     */
    public function testCantBeLoadedInvaidLocation()
    {
        $textLoader = new TextFileLoader(new FileLocation(new Stringy('abc_'.$this->imageFile)));
        $this->expectException(InvalidFileLocationException::class);
        $textLoader->loadFile();
    }
}
