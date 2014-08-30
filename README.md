Csv
====

Read and write tsv & csv.

__Install__  
```bash
$ composer install cfralick/flatfile
```

__Basic Usage__  
```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
use FlatFile\CsvFile;;

$csv = new CsvFile('file.csv');

$csv->writeRow(['1','2','3']);
// writes "1","2","3"
```

