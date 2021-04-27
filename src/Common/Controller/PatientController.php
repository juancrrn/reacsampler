<?php

namespace Juancrrn\Reacsampler\Common\Controller;

use Exception;
use Juancrrn\Reacsampler\Common\App;

/**
 * Vistas de tipo de usuario paciente (Patient)
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class PatientController implements ControllerModel
{

    private $controllerInstance;

    public function __construct(Controller $controllerInstance)
    {
        $this->controllerInstance = $controllerInstance;
    }

    public function runRouting(): void
    {
        $viewManager = App::getSingleton()->getViewManagerInstance();
        
        // Lista de pruebas propias
        $this->controllerInstance->get('/patient/tests/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Detalle de una prueba propia (funcionalidad adicional)
        $this->controllerInstance->get('/patient/tests/([0-9]+])/detail/', function (int $testId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });
    }
}

?>