<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 09/04/16
 * Time: 21:09
 */

namespace Test\DiTesto;


use LazyEight\BasicTypes\Stringy;
use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\TextFileValidator;
use LazyEight\DiTesto\ValueObject\FileLocation;

class TextFileValidatorTest extends \PHPUnit_Framework_TestCase
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
     * @covers \LazyEight\DiTesto\TextFileValidator::__construct
     * @uses \LazyEight\DiTesto\TextFileValidator
     * @return \LazyEight\DiTesto\TextFileValidator
     */
    public function testCanBeCreated()
    {
        $filename = new Stringy($this->file);
        $instance = new TextFileValidator(new FileLocation($filename));
        $this->assertInstanceOf(TextFileValidator::class, $instance);
        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileValidator::validate
     * @uses \LazyEight\DiTesto\TextFileValidator
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\TextFileValidator
     * @param \LazyEight\DiTesto\TextFileValidator
     */
    public function testValidationSuccess(TextFileValidator $validator)
    {
        $this->assertTrue($validator->validate());
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileValidator::validate
     * @expectedException \LazyEight\DiTesto\Exceptions\InvalidFileLocationException
     * @uses \LazyEight\DiTesto\TextFileValidator
     */
    public function testLocationValidation()
    {
        $this->expectException(InvalidFileLocationException::class);
        $fileLocationError = new Stringy('abc/' . $this->file);
        (new TextFileValidator(new FileLocation($fileLocationError)))->validate();
    }

    /**
     * @covers \LazyEight\DiTesto\TextFileValidator::validate
     * @expectedException \LazyEight\DiTesto\Exceptions\InvalidFileTypeException
     * @uses \LazyEight\DiTesto\TextFileValidator
     */
    public function testFileTypeValidation()
    {
        $this->expectException(InvalidFileTypeException::class);
        $fileLocationError = new Stringy($this->imageFile);
        (new TextFileValidator(new FileLocation($fileLocationError)))->validate();
    }
}