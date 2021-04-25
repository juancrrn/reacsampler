<?php

/**
 * Gesión del formulario de cierre de sesión.
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

class LogoutForm extends StaticForm
{

    private const FORM_ID = 'form-logout';

    public function __construct(string $action)
    {
        parent::__construct(self::FORM_ID, array('action' => $action));
    }
    
    protected function generateFields(array & $preloadedData = array()): string
    {
        return App::getSingleton()->getViewManagerInstance()->generateTemplateRender(
            'forms/auth/inputs_logout_form',
            array()
        );
    }
    
    protected function process(array & $datos): void
    {
        $app = App::getSingleton();

        $app->getSessionInstance()->doLogOut();

        $app->getViewManagerInstance()->addSuccessMessage('Se ha cerrado la sesión correctamente.', '');
    }
}

?>