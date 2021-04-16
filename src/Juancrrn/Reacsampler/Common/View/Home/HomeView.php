<?php 

namespace Juancrrn\Reacsampler\Common\View\Home;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\ViewModel;

/**
 * Error 404: no encontrado.
 *
 * @package awsw-gesi
 * Gesi
 * Aplicación de gestión de institutos de educación secundaria
 *
 * @author Andrés Ramiro Ramiro
 * @author Nicolás Pardina Popp
 * @author Pablo Román Morer Olmos
 * @author Juan Francisco Carrión Molina
 *
 * @version 0.0.4
 */

class HomeView extends ViewModel
{

    private const VIEW_RESOURCE_FILE = 'home/view_home';
    public const VISTA_NOMBRE = "Inicio";
    public const VISTA_ID = "home";

    public function __construct()
    {
        $this->nombre = self::VISTA_NOMBRE;
        $this->id = self::VISTA_ID;
    }

    public function processContent(): void
    {
        $app = App::getSingleton();

        $filling = array();

        $app->getViewManagerInstance()->renderTemplate(self::VIEW_RESOURCE_FILE, $filling);
    }
}

?>