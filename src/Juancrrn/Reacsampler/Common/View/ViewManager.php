<?php 

namespace Juancrrn\Reacsampler\Common\View;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\Common\FooterPartView;
use Juancrrn\Reacsampler\Common\View\Common\HeaderPartView;

/**
 * Métodos relacionados con las vistas y la generación de contenido visible 
 * para el usuario en el navegador.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class ViewManager
{
    // Título de la página actual.
    private $currentPageName;

    // Id de la página actual.
    private $currentPageId;

    // Directorio donde se encuentran los ficheros comunes.
    private $viewResourcesPath;

    // Valor de $_SESSION donde se almacenan los mensajes.
    private const SESSION_MENSAJES = "gesi_mensajes";

    private const TEMPLATE_FILE_EXTENSION = '.html';

    public function __construct(string $viewResourcesPath)
    {
        $this->viewResourcesPath = $viewResourcesPath;
    }

    /**
     * Establece el nombre y el id de la página actual.
     * 
     * @param string $nombre Nombre de la página actual.
     * @param string $id Identificador de la página actual.
     */
    private function setCurrentPage(string $name, string $id): void
    {
        $this->currentPageName = $name;
        $this->currentPageId = $id;
    }

    /**
     * Devuelve el nombre de la página actual.
     * 
     * @return string Nombre de la página actual.
     */
    public function getCurrentPageName(): string
    {
        return $this->currentPageName;
    }

    /**
     * Devuelve el id de la página actual.
     * 
     * @return string Id de la página actual.
     */
    public function getCurrentPageId(): string
    {
        return $this->currentPageId;
    }

    /**
     * Genera la cabecera HTML y la incluye.
     */
    private static function injectHeader(): void
    {
        (new HeaderPartView())->processContent();
    }

    /**
     * Genera el pie HTML y lo incluye.
     */
    private static function injectFooter(): void
    {
        (new FooterPartView())->processContent();
    }

    /**
     * 
     * Mensajes para el usuario.
     * 
     */

    /**
     * Añade un mensaje de error a la cola de mensajes para el usuario.
     * 
     * @param string $message Mensaje a mostrar al usuario.
     * @param string $header_location Opcional para redirigir al mismo tiempo 
     * que se encola el mensaje.
     */
    public static function addErrorMessage(string $mensaje, string $header_location = null): void
    {
        $_SESSION[self::SESSION_MENSAJES][] = array(
            "tipo" => "error",
            "contenido" => $mensaje
        );

        if ($header_location !== null) {
            header("Location: " . App::getSingleton()->getUrl() . $header_location);
            die();
        }
    }
    
    /**
     * Añade un mensaje de éxito a la cola de mensajes para el usuario.
     * 
     * @param string $message Mensaje a mostrar al usuario.
     * @param string $header_location Opcional para redirigir al mismo tiempo 
     * que se encola el mensaje.
     */
    public static function addSuccessMessage(string $mensaje, string $header_location = null): void
    {
        $_SESSION[self::SESSION_MENSAJES][] = array(
            "tipo" => "exito",
            "contenido" => $mensaje
        );

        if ($header_location !== null) {
            header("Location: " . App::getSingleton()->getUrl() . $header_location);
            die();
        }
    }

    /**
     * Genera un elemento Bootstrap toast para mostrar un mensaje.
     */
    public static function generateToast(string $tipo, string $contenido): string
    {
        $app = App::getSingleton();
        $autohide = $app->isDevMode() ? 'false' : 'true';
        $appNombre = $app->getName();

        $toast = <<< HTML
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="$autohide" data-delay="3000">
            <div class="toast-header">
                <span class="type-indicator $tipo"></span>
                <strong class="mr-auto">$appNombre</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="toast-body">$contenido</div>
        </div>
        HTML;

        return $toast;
    }

    /**
     * Imprime todos los mensajes de la cola de mensajes.
     */
    public static function printMessages(): void
    {
        echo '<div id="toasts-container" aria-live="polite" aria-atomic="true">';

        if (! empty($_SESSION[self::SESSION_MENSAJES])) {
            foreach ($_SESSION[self::SESSION_MENSAJES] as $clave => $mensaje) {
                echo self::generateToast($mensaje['tipo'], $mensaje['contenido']);

                // Eliminar mensaje de la cola tras mostrarlo.
                unset($_SESSION[self::SESSION_MENSAJES][$clave]);
            }
        }

        echo '</div>';
    }

    /**
     * Comprueba si hay algún mensaje de error en la cola de mensajes.
     */
    public static function anyErrorMessages(): bool
    {
        if (! empty($_SESSION[self::SESSION_MENSAJES])) {
            foreach ($_SESSION[self::SESSION_MENSAJES] as $mensaje) {
                if ($mensaje["tipo"] == "error") {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Dibuja una vista completa y detiene la ejecución del script.
     */
    public function render(ViewModel $vista): void
    {
        $this->setCurrentPage($vista->getName(), $vista->getId());
        
        self::injectHeader();

        self::printMessages();

        echo <<< HTML
        <div id="main-container" class="container mt-4 mb-4">
        HTML;

        $vista->processContent();

        echo <<< HTML
        </div>
        HTML;

        self::injectFooter();

        //die(); // TODO No necesario
    }

    /**
     * Genera un item de una lista no ordenada (<li> de una <ul>) para el menú 
     * principal lateral.
     * 
     * Por defecto añade la ruta de la URL principal al principio del enlace.
     * 
     * @param string $url
     * @param string $titulo
     * @param string $paginaId Identificador de la página de destino, para saber
     *                         si es la actual.
     */
    public function generateSideMenuLink(string $url, $vistaClase): string
    {
        $paginaId = $vistaClase::VISTA_ID;
        $titulo = $vistaClase::VISTA_NOMBRE;

        $appUrl = App::getSingleton()->getUrl();

        $activeClass = $this->getCurrentPageId() === $paginaId ? 'active' : '';

        $classAttr = 'class="list-group-item list-group-item-action ' . $activeClass . '"';
        $hrefAttr = 'href="' . $appUrl . $url . '"';

        $a = <<< HTML
        <a $classAttr $hrefAttr>$titulo</a>
        HTML;

        return $a;
    }

    /**
     * Genera un item de una lista no ordenada (<li> de una <ul>) para el menú 
     * de sesión de usuario.
     * 
     * Por defecto añade la ruta de la URL principal al principio del enlace.
     * 
     * @param string $content
     * @param string|null $paginaId Identificador de la página de destino, para 
     *                              saber si es la actual.
     */
    public function generateUserMenuItem(string $content, $paginaId = null): string
    {
        $activeClass = $this->getCurrentPageId() === $paginaId ? 'active' : '';

        $classAttr = 'class="nav-item ' . $activeClass . '"';

        $span = <<< HTML
        <span $classAttr>$content</span>
        HTML;

        return $span;
    }

    /**
     * Genera un item divisor de una lista no ordenada (<li> de una <ul>) para 
     * el menú principal lateral.
     * 
     * @param string $title
     */
    public function generateSideMenuDivider(string $title): string
    {
        $classAttr = 'class="list-group-item mt-3 side-menu-divider"';

        $li = <<< HTML
        <li $classAttr>$title</li>
        HTML;

        return $li;
    }

    /*protected function getViewResourcesPath(): string
    {
        return $this->viewResourcesPath;
    }*/

    /**
     * Genera un contenido visual final a partir de un fichero de plantilla y
     * algunos valores.
     * 
     * @param string $fileName  Nombre del fichero, dentro del directorio de
     *                          recursos.
     * @param array $filling    Array clave-valor con los nombres de los
     *                          placeholders y sus valores.
     * 
     *                          Se recomiendan nombres de placeholders de tipo
     *                          #nombre-compuesto#.
     * 
     *                          Solo pueden darse valores de tipo cadena de
     *                          texto.
     */
    public function renderTemplate(
		string $fileName,
		array $filling
	): void
	{
		$result = file_get_contents($this->viewResourcesPath . DIRECTORY_SEPARATOR . $fileName . self::TEMPLATE_FILE_EXTENSION);
		
		if (! $result || empty($result)) {
			ddl("File not found or empty", $this->viewResourcesPath . DIRECTORY_SEPARATOR . $fileName . self::TEMPLATE_FILE_EXTENSION);
		} else {
            // Preparar los nombres de los placeholders.

            $names = array_keys($filling);

            for ($i = 0; $i < count($names); $i++) {
                $names[$i] = '#' . $names[$i] . '#';
            }

			$result = str_replace($names, array_values($filling), $result);
			
			echo $result;
		}
	}
}

?>