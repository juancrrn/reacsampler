<?php

require_once __DIR__ . '/../config/init.php';

use Juancrrn\Reacsampler\Common\Controller;
use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\Home\HomeView;

$app = App::getSingleton();

$controller = $app->getControllerInstance();

$viewManager = $app->getViewManagerInstance();

$controller->get('/?', function () use ($viewManager) {
    $viewManager->render(new HomeView());
});

$controller->default(function () {
    echo "Hello";
});

?>