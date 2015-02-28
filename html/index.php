<?php
require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function () use ($app) {
    echo "Hello World";
});

$app->run();
