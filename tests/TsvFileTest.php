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
    
    public function testWriteRows()
    {
        $this->csvInstance->writeRows(static::$rows);
        $rd = new static::$csvClass(static::$tmpFileName);
        foreach($rd as $r) {
            $this->assertEquals(static::$row, $r);
        }
    }
}
