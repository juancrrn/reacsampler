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

namespace Juancrrn\Reacsampler\Domain\StaticForm\Auth;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Domain\StaticForm\StaticForm;
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

        return App::getSingleton()->getViewManagerInstance()->generateTemplateRender(
            'forms/auth/inputs_login_form',
            array(
                'nif' => $nif
            )
        );
    }
    
    protected function process(array & $postedData): void
    {
        $app = App::getSingleton();
        $view = $app->getViewManagerInstance();

        $userRepository = new UserRepository($app->getDbConn());
        
        $nif = isset($postedData['nif']) ? $postedData['nif'] : null;
                
        if (empty($nif)) {
            $view->addErrorMessage('El NIF o NIE no puede estar vacío.');
        } elseif (! $userRepository->findByGovId($nif)) {
            $view->addErrorMessage('El NIF o NIE y la contraseña introducidos no coinciden.');
        }
        
        $password = isset($postedData['password']) ? $postedData['password'] : null;
        
        if (empty($password)) {
            $view->addErrorMessage('La contraseña no puede estar vacía.');
        }

        // Si no hay ningún error, continuar.
        if (! $view->anyErrorMessages()) {
            $userId = $userRepository->findByGovId($nif);

            // Comprobar si la contraseña es correcta.
            if (! password_verify($password, $userRepository->retrieveJustHashedPasswordById($userId))) {
                $view->addErrorMessage('El NIF o NIE y la contraseña introducidos no coinciden.');
            } else {
                $sessionManager = $app->getSessionInstance();

                $sessionManager->doLogIn($userRepository->retrieveById($userId));

                header("Location: " . $app->getUrl());
                die();
            }

        }

        $this->initialize();
    }
}

?>