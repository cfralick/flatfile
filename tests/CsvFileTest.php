<?php
/*
 * Skeleton test case for subclasses of Guzzle\Service\Resource\Model
 * TODO: Tests for log file handling, individual commands,
 * correct subscriber behavior.
 */

namespace FlatFile\Tests;

use FlatFile\CsvFile;

class CsvTest extends \PHPUnit_Framework_TestCase
{
    protected static $csvClass;
    protected static $tmpFileName;
    protected static $row;
    protected static $rows;
    protected static $expectedRowsWritten;
    protected $csvInstance;

    public static function setUpBeforeClass()
    {
        static::$csvClass = "\\FlatFile\\CsvFile";
        static::$tmpFileName = "csvfile.csv";
        $row = range(0,10);
        $rows = [];
        foreach($row as $i) {
            $rows[] = $row;
        }
        static::$row = $row;
        static::$rows = $rows;
        static::$expectedRowsWritten = 11;
    }
    
    protected function setUp()
    {
        $this->csvInstance = new static::$csvClass(static::$tmpFileName);
    } 

    protected function tearDown()
    {
        if(is_readable(realpath(static::$tmpFileName))) {
            unlink(realpath(static::$tmpFileName));
        }
        $this->csvInstance = null;
    }

    public function testCsvClassInstantiated()
    {
        $this->assertInstanceOf(static::$csvClass, $this->csvInstance);
    }
    public function testCsvClassUsesCommaDelimiter()
    {
        $this->assertEquals(',', $this->csvInstance->getDelimiter());
    }
    
    public function testWriteRowsWritesCorrectNumberOfRows()
    {
        $written = $this->csvInstance->writeRows(static::$rows);
        $this->assertEquals(static::$expectedRowsWritten, $written);
    }   

    public function testWriteRowsWritesCorrectContent()
    {
        $written = $this->csvInstance->writeRows(static::$rows);
        $rd = new static::$csvClass(static::$tmpFileName);
        foreach($rd as $r) {
            $this->assertEquals(static::$row, $r);
        }
    }
}
