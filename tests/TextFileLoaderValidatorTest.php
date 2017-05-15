<?php

namespace Test\DiTesto;

use LazyEight\DiTesto\Exceptions\InvalidFileLocationException;
use LazyEight\DiTesto\Exceptions\InvalidFileTypeException;
use LazyEight\DiTesto\Validator\TextFileLoaderValidator;
use LazyEight\DiTesto\ValueObject\FileLocation;
use PHPUnit\Framework\TestCase;

class TextFileValidatorTest extends TestCase
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
     * @covers \LazyEight\DiTesto\Validator\TextFileLoaderValidator::__construct
     * @uses \LazyEight\DiTesto\Validator\TextFileLoaderValidator
     * @return \LazyEight\DiTesto\Validator\TextFileLoaderValidator
     */
    public function testCanBeCreated()
    {
        $filename = $this->file;
        $instance = new TextFileLoaderValidator(new FileLocation($filename));
        $this->assertInstanceOf(TextFileLoaderValidator::class, $instance);
        return $instance;
    }

    /**
     * @covers \LazyEight\DiTesto\Validator\TextFileLoaderValidator::validate
     * @covers \LazyEight\DiTesto\Validator\AbstractTextFileValidator::validate
     * @covers \LazyEight\DiTesto\Validator\AbstractTextFileValidator::getFileLocation
     * @uses \LazyEight\DiTesto\Validator\TextFileLoaderValidator
     * @depends testCanBeCreated
     * @uses \LazyEight\DiTesto\Validator\TextFileLoaderValidator
     * @param \LazyEight\DiTesto\Validator\TextFileLoaderValidator
     */
    public function testValidationSuccess(TextFileLoaderValidator $validator)
    {
        $this->assertTrue($validator->validate());
    }

    /**
     * @covers \LazyEight\DiTesto\Validator\TextFileLoaderValidator::validate
     * @covers \LazyEight\DiTesto\Validator\TextFileLoaderValidator::getFileLocation
     * @covers \LazyEight\DiTesto\Validator\AbstractTextFileValidator::validate
     * @covers \LazyEight\DiTesto\Validator\AbstractTextFileValidator::getFileLocation
     * @expectedException \LazyEight\DiTesto\Exceptions\InvalidFileLocationException
     * @uses \LazyEight\DiTesto\Validator\TextFileLoaderValidator
     */
    public function testLocationValidation()
    {
        $this->expectException(InvalidFileLocationException::class);
        $fileLocationError = 'abc/'.$this->file;
        (new TextFileLoaderValidator(new FileLocation($fileLocationError)))->validate();
    }

    /**
     * @covers \LazyEight\DiTesto\Validator\TextFileLoaderValidator::validate
     * @expectedException \LazyEight\DiTesto\Exceptions\InvalidFileTypeException
     * @uses \LazyEight\DiTesto\Validator\TextFileLoaderValidator
     */
    public function testFileTypeValidation()
    {
        $this->expectException(InvalidFileTypeException::class);
        $fileLocationError = $this->imageFile;
        (new TextFileLoaderValidator(new FileLocation($fileLocationError)))->validate();
    }
}