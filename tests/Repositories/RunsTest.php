<?php
namespace TrainInfo\Repositories;

use TrainInfo\Models\Run;

class RunsTest extends \PHPUnit_Framework_TestCase
{
    public $repo;
   
    public function setUp()
    {
        $this->repo = new Runs;
        $this->repo->addRun(new Run('line4', 'route4', 'run4', 'operator4'));
        $this->repo->addRun(new Run('line2', 'route2', 'run2', 'operator2'));
        $this->repo->addRun(new Run('line1', 'route1', 'run1', 'operator1'));
        $this->repo->addRun(new Run('line3', 'route3', 'run3', 'operator3'));
        $this->repo->addRun(new Run('line4', 'route4', 'run4', 'operator4'));
    }

    public function testRunsSortedByRunNumber()
    {
        $previousRunNumber = '';
        foreach ($this->repo->getAll() as $run) {
            $this->assertTrue($run->number > $previousRunNumber);
            $previousRunNumber = $run->number;
        }
    }

    public function testThereAreNoDuplicateRuns()
    {
        $runs = $this->repo->getAll();
        $this->assertTrue($runs == array_unique($runs));
    }
}
