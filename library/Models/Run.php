<?php
namespace TrainInfo\Models;

class Run
{
    public $line;
    public $number;
    public $operatorId;
    public $route;

    public function __construct($line, $route, $number, $operatorId)
    {
        $this->line = $line;
        $this->route = $route;
        $this->number = $number;
        $this->operatorId = $operatorId;
    }

    public function __toString()
    {
        return $this->number;
    }
}
