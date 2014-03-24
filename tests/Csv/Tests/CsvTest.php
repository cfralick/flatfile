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
        return;
    }

    public function testCsvClassInstantiated()
    {
        $this->assertInstanceOf('\\Csv\\Csv', new \Csv\Csv('csv'));
    }

    public function testCsvWrite()
    {
        $wr = new Csv('w');
        $row = [1,2,3,4,5];
        $wr->writeRow($row);
        $rd = new Csv('w');
        foreach($rd as $r) {
            $this->assertEquals($r, $row);
        }
    }
}
