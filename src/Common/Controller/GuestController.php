<?php

namespace Juancrrn\Reacsampler\Common\Controller;

use Exception;
use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\Auth\LoginView;
use Juancrrn\Reacsampler\Common\View\Error\Error404View;
use Juancrrn\Reacsampler\Common\View\Home\HomeView;

/**
 * Vistas de tipo de usuario invitado, es decir, cualquiera en general o
 * cualquiera que no haya iniciado sesión.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class GuestController implements ControllerModel
{

    private $controllerInstance;

    public function __construct(Controller $controllerInstance)
    {
        $this->controllerInstance = $controllerInstance;
    }

    public function runRouting(): void
    {
        $viewManager = App::getSingleton()->getViewManagerInstance();
        
        $this->controllerInstance->get('/?', function () use ($viewManager) {
            $viewManager->render(new HomeView);
        });

        // Inicio de sesión
        $this->controllerInstance->get('/auth/login/', function () use ($viewManager) {
            $viewManager->render(new LoginView);
        });

        // Envío del formulario de inicio de sesión
        $this->controllerInstance->post('/auth/login/', function () use ($viewManager) {
            $viewManager->render(new LoginView);
        });

        // Restablecimiento de contraseña
        $this->controllerInstance->get('/auth/reset/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });
        
        // Envío del formulario de restablecimiento de contraseña
        $this->controllerInstance->post('/auth/reset/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });
    }

    public function runDefaultRouting(): void
    {
        $viewManager = App::getSingleton()->getViewManagerInstance();
        
        $this->controllerInstance->default(function () use ($viewManager) {
            $viewManager->render(new Error404View);
        });
    }
}

?>