<?php

namespace Juancrrn\Reacsampler\Common\View\Domain\Lab;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\ViewModel;

/**
 * Vista de COMPLETAR
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class LabTestsView extends ViewModel
{

    private const VIEW_RESOURCE_FILE    = 'domain/lab/view-lab-tests';
    public  const VIEW_NAME             = 'Pruebas pendientes';
    public  const VIEW_ID               = 'lab-view-lab-tests';
    public  const VIEW_ROUTE            = '/lab/tests/';

    public function __construct()
    {
        $this->name = self::VIEW_NAME;
        $this->id = self::VIEW_ID;
    }

    public function processContent(): void
    {
        $app = App::getSingleton();

        $filling = array(
            'app-name' => $app->getName(),
            'app-url' => $app->getUrl()
        );

        $app->getViewManagerInstance()->renderTemplate(self::VIEW_RESOURCE_FILE, $filling);
    }
}

?>