<?php
require '../vendor/autoload.php';

$app = new \Slim\Slim();

new \Loyalty\Home($app);

$app->run();
