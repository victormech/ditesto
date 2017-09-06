<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\Collections\ArrayObjectLine;
use PHPUnit\Framework\TestCase;

class ArrayObjectLineTest extends TestCase
{
    protected $textToTest = 'the possibility that there are detectable and measurable patterns that indicate the';

    /**
     * @covers \LazyEight\DiTesto\Collections\ArrayObjectLine::__construct
     * @uses \LazyEight\DiTesto\Collections\ArrayObjectLine
     * @return \LazyEight\DiTesto\Collections\ArrayObjectLine
     */
    public function testCanBeCreated()
    {
        $instance = new ArrayObjectLine([$this->textToTest]);
        $this->assertInstanceOf(ArrayObjectLine::class, $instance);

        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\Collections\ArrayObjectLine::getRawContent
     * @depends testCanBeCreated
     */
    public function testCanReturnTheContent(ArrayObjectLine $arrayObjectLine)
    {
        $this->assertEquals($this->textToTest, $arrayObjectLine->getRawContent());
    }
}
