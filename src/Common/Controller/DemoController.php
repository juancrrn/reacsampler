<?php

namespace Juancrrn\Reacsampler\Common\Controller;

use Exception;
use Juancrrn\Reacsampler\Common\App;

/**
 * Vistas de demostración o de generación de datos de prueba.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class DemoController implements ControllerModel
{

    private $controllerInstance;

    public function __construct(Controller $controllerInstance)
    {
        $this->controllerInstance = $controllerInstance;
    }

    public function runRouting(): void
    {
        $viewManager = App::getSingleton()->getViewManagerInstance();
        
        /*$controller->get('/demo/inject/', function () use ($viewManager, $app) {
            var_dump((new UserRepository($app->getDbConn()))->retrieveAll());
        });*/

        /*$controller->get('/demo/gen/users/', function () use ($viewManager, $app) {
            require_once __DIR__ . '/../test/GenerateDemoUsers.php';
        });*/
    }
}

?>