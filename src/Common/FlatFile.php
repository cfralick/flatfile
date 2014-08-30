<?php
/**
 * Abstract class FlatFile
 * provides default constants for file formatting
 */

namespace FlatFile\Common;

use Keboola\Csv\CsvFile as BaseFile;
use FlatFile\Common\FlatFileInterface;


abstract class FlatFile extends BaseFile implements FlatFileInterface
{
    const QUOTECHAR = '"';
    const ESCAPECHAR = '\\';
    const TERMINATOR = '\n';
    const DELIMITER = ',';
    
    /**
     * Constructor
     * @param string $filename
     * @param string $delimiter
     * @param string $quotechar
     * @param string $escapechar
     * @param string $terminator
     */ 
    public function __construct($filename, $delimiter = null, $quotechar = null, $escapechar = null, $terminator = null)
    {
        // Must set defaults here so subclasses can easily override
        $delimiter = $delimiter ?: static::DELIMITER;
        $quotechar = $quotechar ?: static::QUOTECHAR;
        $escapechar = $escapechar ?: static::ESCAPECHAR;
        $terminator = $terminator ?: static::TERMINATOR;

        parent::__construct($filename, $delimiter, $quotechar, $escapechar);
    }
    
    public function writeRow(array $row, $mode = self::WRITEMODE)
    {
        // Keboola\Csv\CsvFile has no default $mode in method signature
        return parent::writeRow($row, $mode);
    }

    /**
     * Write mulitiple rows to the same csv file. Each row must have the 
     * same number of fields. Rows should already be sorted or otherwised 
     * organized.
     * @param array $rows
     * @param string $mode
     *
     * @return int $rowCount the number of rows written
     */
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

        return $rowCount;
    }
}
