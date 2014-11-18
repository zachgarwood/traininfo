<?php
namespace TrainInfo\Controllers;

class RunDataUploadTest extends \PHPUnit_Framework_TestCase
{
    public $upload;
   
    public function setUp()
    {
        $this->upload = new RunDataUpload(__DIR__ . "/../fixtures/rundata.csv");
    }

    public function testRunsSortedByRunNumber()
    {

        $previousRunNumber = '';
        foreach ($this->upload->getRuns() as $run) {
            $this->assertTrue($run->number > $previousRunNumber);
            $previousRunNumber = $run->number;
        }
    }

    public function testThereAreNoDuplicateRuns()
    {
        $runs = $this->upload->getRuns();
        $this->assertTrue($runs == array_unique($runs));
    }
}
