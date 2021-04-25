<?php

namespace Juancrrn\Reacsampler\Common\View\Auth;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\ViewModel;
use Juancrrn\Reacsampler\Domain\StaticForm\Auth\LoginForm;

/**
 * Vista de inicio de sesión.
 *
 * Invitado (cualquiera): puede iniciar sesión.
 *
 * @package awsw-gesi
 * Gesi
 * Aplicación de gestión de institutos de educación secundar
 * 
 * @author Andrés Ramiro Ramiro
 * @author Nicolás Pardina Popp
 * @author Pablo Román Morer Olmos
 * @author Juan Francisco Carrión Molina
 *
 * @version 0.0.4
 */

class LoginView extends ViewModel
{
    private const VIEW_RESOURCE_FILE = 'auth/view_login';

    public const VIEW_NOMBRE = "Iniciar sesión";
    public const VIEW_ID = "auth-login";

    private $form;

    public function __construct()
    {
        App::getSingleton()->getSessionInstance()->requireNotLoggedIn();

        $this->name = self::VIEW_NOMBRE;
        $this->id = self::VIEW_ID;

        $this->form = new LoginForm('/auth/login/'); 

        $this->form->handle();
        $this->form->initialize();
    }

    public function processContent(): void
    {
        $app = App::getSingleton();

        $filling = array(
            'form-html' => $this->form->getHtml(),
            'reset-url' => $app->getUrl() . '/auth/reset/'
        );

        $app->getViewManagerInstance()->renderTemplate(self::VIEW_RESOURCE_FILE, $filling);
    }
}

?>