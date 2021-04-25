<?php 

namespace Juancrrn\Reacsampler\Common\View\Home;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\ViewModel;

/**
 * Vista de página principal
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class HomeView extends ViewModel
{

    private const VIEW_RESOURCE_FILE = 'home/view_home';
    public const VIEW_NAME = "Inicio";
    public const VIEW_ID = "home";

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