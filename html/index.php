<?php
require '../vendor/autoload.php';

$config = array(
    'templates.path' => '../templates'
);

$app = new \Slim\Slim($config);

new \Loyalty\Home($app);

$app->run();
