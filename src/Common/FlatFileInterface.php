<?php
/**
 * The essential write methods (borrowed from Python's csv module.
 */

namespace FlatFile\Common;

interface FlatFileInterface
{
    const WRITEMODE = 'a';
    const READMODE = 'r';
    
    public function writeRow(array $row, $mode = FlatFileInterface::WRITEMODE);

    public function writeRows(array $rows, $mode = FlatFileInterface::WRITEMODE);
}
