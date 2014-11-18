<?php
namespace TrainInfo\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use TrainInfo\Models\Run;
use TrainInfo\Repositories;

class RunDataUpload
{
    private $runRepository = [];

    public function addFromFile(Request $request, Application $app)
    {
        $filename = $request->files->get($app['file_upload_name'])->getPathname();
        $file = fopen($filename, 'r');
        $labels = fgetcsv($file);
        while (($line = fgetcsv($file)) !== false) {
            list($line, $route, $number, $operatorId) = $this->parseLine($line);
            $app['repositories.runs']->addRun(new Run($line, $route, $number, $operatorId));
        }

        return $app->handle(Request::create('/runs', 'GET'), HttpKernelInterface::SUB_REQUEST);
    }

    private function parseLine($line)
    {
        return array_map(function($item) { return trim($item); }, $line);
    }
}
