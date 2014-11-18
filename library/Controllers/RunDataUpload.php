<?php
namespace TrainInfo\Controllers;

use TrainInfo\Models\Run;

class RunDataUpload
{
    private $runs = [];

    public function __construct($filename) {
        $file = fopen($filename, 'r');
        $labels = fgetcsv($file);
        while (($line = fgetcsv($file)) !== false) {
            list($line, $route, $number, $operatorId) = $this->parseLine($line);
            $this->runs[$number] = new Run($line, $route, $number, $operatorId);
        }
        ksort($this->runs);
    }
    
    public function getRuns()
    {
        return $this->runs;
    }

    private function parseLine($line)
    {
        return array_map(function($item) { return trim($item); }, $line);
    }
}
