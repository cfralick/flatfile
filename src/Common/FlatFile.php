<?php
namespace FlatFile\Common;
use Keboola\Csv\CsvFile as BaseFile;
use FlatFile\Common\FlatFileInterface;


abstract class FlatFile extends BaseFile implements FlatFileInterface
{
    const QUOTECHAR = '"';
    const ESCAPECHAR = '\\';
    const TERMINATOR = '\n';
    const DELIMITER = ',';
    public function __construct($filename = null, $delimiter = null, $quotechar = null, $escapechar = null, $terminator = null)
    {
        $delimiter = $delimiter ?: static::DELIMITER;;
        $quotechar = $quotechar ?: static::QUOTECHAR;
        $escapechar = $escapechar ?: static::ESCAPECHAR;
        $terminator = $terminator ?: static::TERMINATOR;

        parent::__construct($filename, $delimiter, $quotechar, $escapechar);
    }
    public function writeRow(array $row, $mode = self::WRITEMODE)
    {
        return parent::writeRow($row, $mode);
    }

    public function writeRows(array $rows, $mode = self::WRITEMODE)
    {
        $columns = count($rows[0]);
        $rowCount = 0;
        foreach($rows as $row) {
            $cols = count($row);
            if($cols > $columns) {
                $columns = $cols;
            }
            if($cols !== $columns) {
                throw new \InvalidArgumentException(sprintf('row %d has %d columns. Should have %d', $rowCount, $cols, $columns));
            }
            
            $this->writeRow($row, $mode);
            $rowCount++;
        }
    }
}
