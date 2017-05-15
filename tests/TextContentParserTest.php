<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\Parser\TextContentParser;
use LazyEight\DiTesto\ValueObject\FileContent;
use LazyEight\DiTesto\ValueObject\TextFile\Line;
use PHPUnit\Framework\TestCase;

class TextContentParserTest extends TestCase
{
    /**
     * @var string
     */
    protected $file = './tests/files/urls.txt';

    /**
     * @covers \LazyEight\DiTesto\Parser\TextContentParser::__construct
     * @uses \LazyEight\DiTesto\Parser\TextContentParser
     * @return \LazyEight\DiTesto\Parser\TextContentParser
     */
    public function testCanBeCreated()
    {
        $content = file_get_contents($this->file);
        $instance = new TextContentParser(new FileContent($content));
        $this->assertInstanceOf(TextContentParser::class, $instance);
        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\Parser\TextContentParser::parse
     * @covers \LazyEight\DiTesto\Parser\TextContentParser::convertContentToLines
     * @covers \LazyEight\DiTesto\ValueObject\TextFile\TextContent::getValue
     * @covers \LazyEight\DiTesto\ValueObject\TextFile\TextContent::getLines
     * @uses \LazyEight\DiTesto\Parser\TextContentParser
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\Parser\TextContentParser
     * @param \LazyEight\DiTesto\Parser\TextContentParser
     */
    public function testCanBeParsed(TextContentParser $loader)
    {
        $content = file_get_contents($this->file);
        $textContent = $loader->parse();
        $this->assertEquals($textContent->getValue(), $content);
        $this->assertArraySubset($this->getLinesArray($content), $textContent->getLines());
    }

    private function getLinesArray(string $content)
    {
        $linesArr = mb_split('\n', $content);
        $linesCount = count($linesArr);
        for ($i = 0; $i < $linesCount; $i++) {
            $linesArr[$i] = new Line($linesArr[$i]);
        }
        return $linesArr;
    }
}
