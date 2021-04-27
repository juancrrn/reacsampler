<?php

namespace Juancrrn\Reacsampler\Common\Controller;

use Exception;
use Juancrrn\Reacsampler\Common\App;

/**
 * Vistas de tipo de usuario personal de enfermería (NursingStaff)
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class NursingStaffController implements ControllerModel
{

    private $controllerInstance;

    public function __construct(Controller $controllerInstance)
    {
        $this->controllerInstance = $controllerInstance;
    }

    public function runRouting(): void
    {
        $viewManager = App::getSingleton()->getViewManagerInstance();
        
        // Lista de pruebas asignadas pendientes de tomar muestra
        $this->controllerInstance->get('/nursing/tests/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Edición de una prueba (para obtener el identificador y añadir la muestra)
        $this->controllerInstance->get('/nursing/tests/([0-9]+])/sample/', function (int $testId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });
    }
}

?>