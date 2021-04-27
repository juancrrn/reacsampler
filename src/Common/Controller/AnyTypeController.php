<?php

namespace Juancrrn\Reacsampler\Common\Controller;

use Exception;
use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Domain\StaticForm\Auth\LogoutForm;

/**
 * Vistas de tipo de usuario que ha iniciado sesión, sea del tipo que sea.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class AnyTypeController implements ControllerModel
{

    private $controllerInstance;

    public function __construct(Controller $controllerInstance)
    {
        $this->controllerInstance = $controllerInstance;
    }

    public function runRouting(): void
    {
        $viewManager = App::getSingleton()->getViewManagerInstance();
        
        // Envío del formulario de cierre de sesión
        $this->controllerInstance->post('/auth/logout/', function () use ($viewManager) {
            (new LogoutForm('/auth/logout/'))->handle();
        });
        
        // Perfil propio
        $this->controllerInstance->get('/self/profile/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });
    }
}

?>