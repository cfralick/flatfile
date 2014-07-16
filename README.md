Csv
====

A simple-to-use Csv reader/writer.  

__Install__  
```bash
$ composer install cfralick/csv
```

__Basic Usage__  
```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Csv\Csv;

$csv = new Csv('file.csv');

$csv->writeRow(['1','2','3']);
// writes "1","2","3"
```

