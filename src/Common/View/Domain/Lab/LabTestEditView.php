<?php

namespace Juancrrn\Reacsampler\Common\View\Domain\Lab;

use Exception;
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

class LabTestEditView extends ViewModel
{

    private const VIEW_RESOURCE_FILE    = 'domain/lab/view-lab-test-edit';
    public  const VIEW_NAME             = 'Muestrear prueba';
    public  const VIEW_ID               = 'lab-view-lab-test-edit';
    public  const VIEW_ROUTE            = '/lab/tests/([0-9]+)/edit/';

    private $testId;

    public function __construct(int $testId)
    {
        $this->name = self::VIEW_NAME;
        $this->id = self::VIEW_ID;

        $this->testId = $testId;
        throw new Exception('Retrieve test.');
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