# DiTesto
[![Build Status](https://travis-ci.org/victormech/ditesto.svg?branch=master)](https://travis-ci.org/victormech/ditesto) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/victormech/ditesto/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/victormech/ditesto/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/victormech/ditesto/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/victormech/ditesto/?branch=master) [![Codacy Badge](https://api.codacy.com/project/badge/grade/1072cb4bcc2846a18deed7645d1b18c1)](https://www.codacy.com/app/victormech/ditesto) [![Latest Stable Version](https://poser.pugx.org/lazyeight/ditesto/v/stable)](https://packagist.org/packages/lazyeight/ditesto)

##### A simple Object Oriented library to load and manipulate text files with PHP. Made only with PHP.
PHP minimum version: 7

## Usage
```php
$file = '/home/user/text-file.txt';
$textFile = (new TextReader($file))->readFile();
echo $textFile;
```
You can iterate line per line if you want:
```php
$textFile = (new TextReader($file))->readFile();
foreach ($textFile as $line) {
   echo $line;
}
```
You can iterate like an Array :
```php
echo $textFile[0];
$textFile[] = new Line('This is a new line');
echo count($textFile);
```
## License
  
The MIT License (MIT). Please see [License File](https://github.com/victormech/basic-types/blob/master/LICENSE) for more information.
