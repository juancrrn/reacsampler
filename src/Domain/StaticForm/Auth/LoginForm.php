<?php

/**
 * Gesión del formulario de inicio de sesión.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

namespace Juancrrn\Reacsampler\Common\StaticForm\Auth;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\StaticForm\StaticForm;
use Juancrrn\Reacsampler\Domain\User\UserRepository;

class LoginForm extends StaticForm
{

    private const FORM_ID = 'form-login';

    public function __construct(string $action)
    {
        parent::__construct(self::FORM_ID, array('action' => $action));
    }
    
    protected function generateFields(array & $preloadedData = array()): string
    {
        $nif = '';

        if (! empty($preloadedData)) {
            $nif = isset($preloadedData['nif']) ? $preloadedData['nif'] : $nif;
        }

        $html = <<< HTML
        <div class="form-group">
            <label for="nif">NIF o NIE</label>
            <input class="form-control" id="nif" type="text" name="nif" placeholder="NIF o NIE" value="$nif">
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input class="form-control" id="password" type="password" name="password" placeholder="Contraseña">
        </div>
        <button type="submit" class="btn btn-primary" name="login">Continuar</button>
        HTML;

        return $html;
    }
    
    protected function process(array & $postedData): void
    {
        $app = App::getSingleton();
        $view = $app->getViewManagerInstance();

        $nif = isset($postedData['nif']) ? $postedData['nif'] : null;
                
        if (empty($nif)) {
            $view->addErrorMessage('El NIF o NIE no puede estar vacío.');
        } elseif (! UserRepository::findByNif($nif)) {
            $view->addErrorMessage('El NIF o NIE y la contraseña introducidos no coinciden.');
        }
        
        $password = isset($postedData['password']) ? $postedData['password'] : null;
        
        if (empty($password)) {
            $view->addErrorMessage('La contraseña no puede estar vacía.');
        }
        
        // Si no hay ningún error, continuar.
        if (! $view->anyErrorMessages()) {

            $user = UserRepository::retrieveById(UserRepository::findByNif($nif));

            // Comprobar si la contraseña es correcta.
            if (! password_verify($password, $user->getPassword())) {
                $view->addErrorMessage('El NIF o NIE y la contraseña introducidos no coinciden.');
            } else {
                $sessionManager = $app->getSessionInstance();

                $sessionManager->doLogIn($user);

                header("Location: " . $app->getUrl());
                
                die();
            }

        }

        $this->initialize();
    }
}

?>