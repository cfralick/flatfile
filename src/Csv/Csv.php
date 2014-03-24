<?php
namespace Csv;
use Keboola\Csv\CsvFile as BaseCsvFile;

class Csv extends BaseCsvFile
{
    const DELIMITER = ',';
    const QUOTECHAR = '"';
    const ESCAPECHAR = '\\';
    const TERMINATOR = '\n';
    const READMODE = 'r+';
    const WRITEMODE = 'w';
    
    public function __construct(
        $filename = null, 
        $delimiter = self::DELIMITER, 
        $quotechar = self::QUOTECHAR, 
        $escapechar = self::ESCAPECHAR, 
        $terminator = self::TERMINATOR
    )
    {
        parent::__construct($filename, $delimiter, $quotechar, $escapechar);
    }

    private function toRows(array $data)
    {
        return (!isset($data[0]) || !is_array($data[0])) ? [$data] : $data;
    }

    public function writeRow(array $row, $mode = self::WRITEMODE)
    {
        parent::writeRow($row);
    }

    public function writeRows(array $rows, $mode = self::WRITEMODE)
    {
        foreach($this->toRows($rows) as $row) {
            $this->writeRow($row, $mode);
        }
    }
}
