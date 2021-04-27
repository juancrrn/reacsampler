<?php

namespace Juancrrn\Reacsampler\Common\Controller;

use Exception;
use Juancrrn\Reacsampler\Common\App;

/**
 * Vistas de tipo de usuario personal médico (MedicalStaffController)
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class MedicalStaffController implements ControllerModel
{

    private $controllerInstance;

    public function __construct(Controller $controllerInstance)
    {
        $this->controllerInstance = $controllerInstance;
    }

    public function runRouting(): void
    {
        $viewManager = App::getSingleton()->getViewManagerInstance();
        
        // Perfil de un paciente y su lista de pruebas de todo tipo
        $this->controllerInstance->get('/medical/patient/([0-9]+])/view/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Solicitud de una nueva prueba
        $this->controllerInstance->get('/medical/tests/request/([0-9]+])/', function (int $userId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Consulta de una prueba en detalle (funcionalidad adicional)
        $this->controllerInstance->get('/medical/tests/([0-9]+])/detail/', function (int $testId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });
    }
}

?>