<?php 

namespace Juancrrn\Reacsampler\Common\View\Common;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\ViewModel;
use Juancrrn\Reacsampler\Common\View\Home\HomeView;

/**
 * Clase especial para la parte del pie de página.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class HeaderPartView extends ViewModel
{

    private const VIEW_RESOURCE_FILE = 'common/view_part_header';

    public function __construct()
    {
    }

    public function processContent(): void
    {
        $app = App::getSingleton();

        $sessionManager = $app->getSessionInstance();
        $viewManager = $app->getViewManagerInstance();

        //$formulario_logout = new FormularioSesionCerrar('');
        //$formulario_logout->gestiona();
        //$formulario_logout->genera();

        $mainMenuBuffer = '';

        // Generar elementos de navegación del menú lateral.
        $mainMenuBuffer .= $viewManager->generateMainMenuLink('', HomeView::class);

        /*
            $sideMenuBuffer .= Vista::generarSideMenuDivider('Acciones públicas');
            $sideMenuBuffer .= Vista::generarSideMenuLink(
                '/inv/eventos/', EventoInvList::class);

            if (Sesion::isSesionIniciada()) {
                $sideMenuBuffer .= Vista::generarSideMenuDivider('Acciones personales');

                $sideMenuBuffer .= Vista::generarSideMenuLink(
                    '/ses/secretaria/', MensajeSecretariaSesList::class);

                if (Sesion::getUsuarioEnSesion()->isEst()) {
                    $sideMenuBuffer .= Vista::generarSideMenuDivider(
                        'Acciones de estudiantes');

                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/est/asignaciones/', AsignacionEstList::class);
                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/est/asignaciones/horario/', AsignacionEstHorario::class);
                } elseif (Sesion::getUsuarioEnSesion()->isPd()) {
                    $sideMenuBuffer .= Vista::generarSideMenuDivider(
                        'Acciones de personal docente');

                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/pd/asignaciones/', AsignacionPdList::class);
                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/pd/asignaciones/horario/', AsignacionPdHorario::class);
                } elseif (Sesion::getUsuarioEnSesion()->isPs()) {
                    $sideMenuBuffer .= Vista::generarSideMenuDivider(
                        'Acciones de administración');

                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/ps/secretaria/', MensajeSecretariaPsList::class);
                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/ps/asignaturas/', AsignaturaPsList::class);
                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/ps/grupos/', GrupoPsList::class);
                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/ps/usuarios/', UsuarioPsList::class);
                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/ps/asignaciones/', AsignacionPsList::class);
                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/ps/eventos/', EventoPsList::class);
                    $sideMenuBuffer .= Vista::generarSideMenuLink(
                        '/ps/foros/', ForoPsList::class);
                }
            } else {
                $sideMenuBuffer .= Vista::generarSideMenuLink(
                    '/inv/mensajesecretaria/', MensajeSecretariaInvList::class);
            }

            // Generar elementos de la navegación del menú de sesión de usuario.
        */

        $userMenuBuffer = ''; 

        if ($sessionManager->isLoggedIn()) {
            $u = $sessionManager->getLoggedInUser();

            /*$nombre = $u->getNombreCompleto();

            $url_editar = $urlInicio . '/sesion/perfil/';
            
            $badges = '';
            $badges .= $u->isEst() ? '<span class="badge badge-secondary">Estudiante</span>' : '';
            $badges .= $u->isPd() ? '<span class="badge badge-secondary">Personal docente</span>' : '';
            $badges .= $u->isPs() ? '<span class="badge badge-secondary">Personal de Secretaría</span>' : '';

            $formularioLogoutHtml = $formulario_logout->getHtml();

            $userMenuBuffer .= Vista::generarUserMenuItem("<a class=\"nav-link\" href=\"$url_editar\">$nombre $badges</a>", 'mi-perfil');
            $userMenuBuffer .= Vista::generarUserMenuItem($formularioLogoutHtml);*/
        } else {
            $loginUrl = $app->getUrl() . '/auth/login/';

            $userMenuBuffer .= $viewManager->generateUserMenuItem("<a class=\"nav-link\" href=\"$loginUrl\">Iniciar sesión</a>", 'sesion-iniciar');
        }

        $filling = array(
            'app-name' => $app->getName(),
            'current-page-name' => $viewManager->getCurrentPageName(),
            'current-page-id' => $viewManager->getCurrentPageId(),
            'home-url' => $app->getUrl(),
            'v' => (! $app->isDevMode()) ? '' : '?v=0.0.0' . time(),
            'main-menu-items' => $mainMenuBuffer,
            'user-menu-items' => $userMenuBuffer
        );

        $app->getViewManagerInstance()->renderTemplate(self::VIEW_RESOURCE_FILE, $filling);
    }
}

?>