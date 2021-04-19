<?php 

namespace Juancrrn\Reacsampler\Common\View\Error;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\ViewModel;

/**
 * Vista de error 404
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class Error404View extends ViewModel
{

    private const VIEW_RESOURCE_FILE = 'error/view_error_404';
    public const VIEW_NAME = "Error 404: página no encontrada";
    public const VIEW_ID = "error-404";

    public function __construct()
    {
        $this->nombre = self::VIEW_NAME;
        $this->id = self::VIEW_ID;
    }

    public function processContent(): void
    {
        $app = App::getSingleton();

        $filling = array();

        $app->getViewManagerInstance()->renderTemplate(self::VIEW_RESOURCE_FILE, $filling);
    }
}

?>