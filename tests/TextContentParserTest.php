<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 10/04/16
 * Time: 01:38
 */

namespace Test\DiTesto;


use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\Parser\TextContentParser;
use LazyEight\DiTesto\ValueObject\FileContent;
use LazyEight\DiTesto\ValueObject\TextFile\Line;

class TextContentParserTest extends \PHPUnit_Framework_TestCase
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
        $content = new Stringy(file_get_contents($this->file));
        $instance = new TextContentParser(new FileContent($content));
        $this->assertInstanceOf(TextContentParser::class, $instance);
        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\Parser\TextContentParser::parse
     * @covers \LazyEight\DiTesto\Parser\TextContentParser::getValue
     * @covers \LazyEight\DiTesto\Parser\TextContentParser::getLines
     * @uses \LazyEight\DiTesto\Parser\TextContentParser
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\Parser\TextContentParser
     * @param \LazyEight\DiTesto\Parser\TextContentParser
     */
    public function testCanBeParsed(TextContentParser $loader)
    {
        $content = new Stringy(file_get_contents($this->file));
        $textContent = $loader->parse();
        $this->assertEquals($textContent->getValue(), $content);
        $this->assertArraySubset($this->getLinesArray($content), $textContent->getLines());
    }

    private function getLinesArray(Stringy $content)
    {
        $linesArr = $content->split('\n');
        $linesCount = count($linesArr);
        for ($i = 0; $i < $linesCount; $i++) {
            $linesArr[$i] = new Line($linesArr[$i]);
        }
        return $linesArr;
    }
}
