<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\ArrayObjectLine;
use PHPUnit\Framework\TestCase;

class ArrayObjectLineTest extends TestCase
{
    protected $textToTest = 'the possibility that there are detectable and measurable patterns that indicate the';

    /**
     * @covers \LazyEight\DiTesto\ArrayObjectLine::__construct
     * @uses \LazyEight\DiTesto\ArrayObjectLine
     * @return \LazyEight\DiTesto\ArrayObjectLine
     */
    public function testCanBeCreated()
    {
        $instance = new ArrayObjectLine([$this->textToTest]);
        $this->assertInstanceOf(ArrayObjectLine::class, $instance);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\ArrayObjectLine::getRawContent
     * @depends testCanBeCreated
     */
    public function testCanReturnTheContent(ArrayObjectLine $arrayObjectLine)
    {
        $this->assertEquals($this->textToTest, $arrayObjectLine->getRawContent());
    }
}
