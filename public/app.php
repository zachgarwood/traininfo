<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

// Services
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../library/Views',
]);
$app['repositories.runs'] = $app->share(function() {
    return new TrainInfo\Repositories\Runs;
});
$app['controllers.runs'] = $app->share(function() {
    return new TrainInfo\Controllers\Runs;
});
$app['controllers.run_data_upload'] = $app->share(function() {
    return new TrainInfo\Controllers\RunDataUpload;
});
$app['file_upload_name'] = 'run_data';

// Routes
$app->get('/runs', 'TrainInfo\\Controllers\\Runs::index');
$app->post('/upload', 'TrainInfo\\Controllers\\RunDataUpload::addFromFile');

$app->run();
