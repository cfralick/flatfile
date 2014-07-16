<?php
/*
 * Skeleton test case for subclasses of Guzzle\Service\Resource\Model
 * TODO: Tests for log file handling, individual commands,
 * correct subscriber behavior.
 */

namespace Csv\Tests;

use \Csv\Csv;

class CsvTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $row = range(0,10);
        $rows = [];
        foreach($row as $i) {
            $rows[] = $row;
        }
        $this->row = $row;
        $this->rows = $rows;
    }
    protected function tearDown()
    {
        if(is_readable(realpath('writerow'))) {
            unlink(realpath('writerow'));
        }
    }

    public function testCsvClassInstantiated()
    {
        $this->assertInstanceOf('\\Csv\\Csv', new \Csv\Csv('csv'));
    }
    public function testWriteRows()
    {
        $wr = new Csv('writerow');
        $wr->writeRows($this->rows);
        $rd = new Csv('writerow');
        foreach($rd as $r) {
            $this->assertEquals($this->row, $r);
        }
    }
    public function testPoopzor()
    {
        $row = range(0, 5);
        $rows = [];
        foreach($row as $r) {
            $rows[] = range(0, $r);
        }
        $wr = new Csv('writerow');
        $this->setExpectedException('InvalidArgumentException');
        $wr->writeRows($rows);
    }

    public function testCsvWrite()
    {
        $wr = new Csv('writerow');
        $row = range(0,10);
        $wr->writeRow($row);
        $rd = new Csv('writerow');
        foreach($rd as $r) {
            $this->assertEquals($r, $row);
        }
    }
}
