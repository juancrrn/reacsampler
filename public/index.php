<?php

require_once __DIR__ . '/../config/init.php';

use Juancrrn\Reacsampler\Common\Controller;
use Juancrrn\Reacsampler\Common\App;

$controller = App::getSingleton()->getControllerInstance();

$controller->get('/?', function () {
    echo "Home";
});

$controller->default(function () {
    echo "Hello";
});

?>