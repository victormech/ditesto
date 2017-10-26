<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\AbstractFile;
use PHPUnit\Framework\TestCase;

class AbstractFileTest extends TestCase
{
    /**
     * @var string
     */
    private $path = 'PATH';

    /**
     * @var string
     */
    private $content = 'RAW_CONTENT';

    /**
     * @covers \LazyEight\DiTesto\AbstractFile::__construct
     * @uses \LazyEight\DiTesto\AbstractFile
     * @return \LazyEight\DiTesto\AbstractFile
     */
    public function testCanBeCreated()
    {
        $path = $this->path;
        $instance = $this->getMockForAbstractClass(AbstractFile::class, [$path]);
        $this->assertInstanceOf(AbstractFile::class, $instance);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\AbstractFile::__construct
     * @uses \LazyEight\DiTesto\AbstractFile
     */
    public function testCantBeCreated()
    {
        $this->expectException(\TypeError::class);
        $instance = $this->getMockForAbstractClass(AbstractFile::class);
        $instance->setPath($this->path);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\AbstractFile::getPath
     * @covers \LazyEight\DiTesto\AbstractFile::setPath
     * @depends testCanBeCreated
     */
    public function testPath(AbstractFile $file)
    {
        $file->setPath($this->path);
        $this->assertEquals($this->path, $file->getPath());
    }

    /**
     * @covers \LazyEight\DiTesto\AbstractFile::setRawContent
     * @covers \LazyEight\DiTesto\AbstractFile::getRawContent
     * @depends testCanBeCreated
     */
    public function testRawContent(AbstractFile $file)
    {
        $file->setRawContent($this->content);
        $this->assertEquals($this->content, $file->getRawContent());

        return $file;
    }


}
