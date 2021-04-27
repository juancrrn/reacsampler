<?php

namespace Juancrrn\Reacsampler\Common\Controller;

use Exception;
use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\Domain\Lab\LabTestEditView;
use Juancrrn\Reacsampler\Common\View\Domain\Lab\LabTestsView;

/**
 * Vistas de tipo de usuario personal de laboratorio (LabStaff)
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class LabStaffController implements ControllerModel
{

    private $controllerInstance;

    public function __construct(Controller $controllerInstance)
    {
        $this->controllerInstance = $controllerInstance;
    }

    public function runRouting(): void
    {
        $viewManager = App::getSingleton()->getViewManagerInstance();
        
        // Lista de pruebas (muestras) asignadas pendientes de procesar
        $this->controllerInstance->get('/lab/tests/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
            $viewManager->render(new LabTestsView);
        });

        // Edición de una prueba (para añadir el resultado)
        $this->controllerInstance->get('/lab/tests/([0-9]+)/edit/', function (int $testId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
            $viewManager->render(new LabTestEditView($testId));
        });
    }
}

?>