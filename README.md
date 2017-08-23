# DiTesto
[![Build Status](https://travis-ci.org/victormech/ditesto.svg?branch=master)](https://travis-ci.org/victormech/ditesto) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/victormech/ditesto/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/victormech/ditesto/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/victormech/ditesto/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/victormech/ditesto/?branch=master) [![Codacy Badge](https://api.codacy.com/project/badge/grade/1072cb4bcc2846a18deed7645d1b18c1)](https://www.codacy.com/app/victormech/ditesto) [![Latest Stable Version](https://poser.pugx.org/lazyeight/ditesto/v/stable)](https://packagist.org/packages/lazyeight/ditesto)

##### A simple Object Oriented library to load and manipulate text files with PHP. Made only with PHP.
PHP minimum version: 7

## Usage
```php
$file = '/home/user/text-file.txt';
$textFile = new TextFile($file); 
echo $textFile; // prints all file content
```
You can iterate line per line if you want:
```php
$textFile = new TextFile($file); 
(new TextFileReader())->readFile($textFile);
foreach ($textFile as $line) {
   echo $line;
}
```
Or even like an Array:
```php
$textFile[] = new Line('Adding a new line');
$textFile[0] = new Line('Changing an existent line');
echo count($textFile); // prints total of lines
echo $textFile[1]; // prints only the second line 
```
To persist your changes:
```php
(new TextFileWriter())->writeFile($textFile);
```
## License
  
The MIT License (MIT). Please see [License File](https://github.com/victormech/basic-types/blob/master/LICENSE) for more information.
