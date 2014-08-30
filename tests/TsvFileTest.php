<?php
/*
 * Skeleton test case for subclasses of Guzzle\Service\Resource\Model
 * TODO: Tests for log file handling, individual commands,
 * correct subscriber behavior.
 */

namespace FlatFile\Tests;

use \FlatFile\TsvFile;

class TsvFileTest extends \PHPUnit_Framework_TestCase
{
    protected static $csvClass;
    protected static $tmpFileName;
    protected static $row;
    protected static $rows;
    protected static $expectedRowsWritten;
    protected $csvInstance;

    public static function setUpBeforeClass()
    {
        static::$csvClass = "\\FlatFile\\TsvFile";
        static::$tmpFileName = "tsvfile.tsv";
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

    public function testTsvClassInstantiated()
    {
        $this->assertInstanceOf(static::$csvClass, $this->csvInstance);
    }

    public function testTsvClassUsesTabDelimiter()
    {
        $this->assertEquals("\t", $this->csvInstance->getDelimiter());
    }
    
    public function testCorrectNumberOfRowsWritten()
    {
        $written = $this->csvInstance->writeRows(static::$rows);
        $this->assertEquals(static::$expectedRowsWritten, $written);
    }

    public function testCorrectDataWritten()
    {
        $written = $this->csvInstance->writeRows(static::$rows);
        $rd = new static::$csvClass(static::$tmpFileName);
        foreach($rd as $r) {
            $this->assertEquals(static::$row, $r);
        }
    }
}
