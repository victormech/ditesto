<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\Line;
use PHPUnit\Framework\TestCase;

class LineTest extends TestCase
{
    /**
     * @var string
     */
    protected $textToTest = 'the possibility that there are detectable and measurable patterns that indicate the';

    /**
     * @covers \LazyEight\DiTesto\Line::__construct
     * @uses \LazyEight\DiTesto\Line
     * @return \LazyEight\DiTesto\Line
     */
    public function testCanBeCreated()
    {
        $instance = new Line($this->textToTest);
        $this->assertInstanceOf(Line::class, $instance);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\Line::getContent
     * @covers \LazyEight\DiTesto\Line::__construct
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\TextFileReader
     */
    public function testCanGetContent(Line $line)
    {
        $this->assertEquals($this->textToTest, $line->getContent());
    }

    /**
     * @covers \LazyEight\DiTesto\Line::__toString
     * @covers \LazyEight\DiTesto\Line::__construct
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\TextFileReader
     */
    public function testCanToString(Line $line)
    {
        $this->assertEquals($this->textToTest, $line->__toString());
    }
}
