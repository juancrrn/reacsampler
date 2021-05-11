<?php 

namespace Juancrrn\Reacsampler\Common\View\Common;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\Auth\LoginView;
use Juancrrn\Reacsampler\Common\View\Domain\Lab\LabTestEditView;
use Juancrrn\Reacsampler\Common\View\Domain\Lab\LabTestsView;
use Juancrrn\Reacsampler\Common\View\ViewModel;
use Juancrrn\Reacsampler\Common\View\Home\HomeView;
use Juancrrn\Reacsampler\Domain\StaticForm\Auth\LogoutForm;
use Juancrrn\Reacsampler\Domain\User\User;

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

        $logoutForm = new LogoutForm('/auth/logout/');
        $logoutForm->handle();
        $logoutForm->initialize();

        $mainMenuBuffer = '';

        // Generar elementos de navegación del menú lateral.
        $mainMenuBuffer .= $viewManager->generateMainMenuLink(HomeView::class);

        if ($sessionManager->isLoggedIn()) {
            $user = $sessionManager->getLoggedInUser();

            switch ($user->getType()) {
                case User::TYPE_LAB_STAFF: {
                    $mainMenuBuffer .= $viewManager->generateMainMenuLink(LabTestsView::class);
                    break;
                }

                case User::TYPE_MANAGEMENT_STAFF: {
                    
                    break;
                }

                case User::TYPE_MEDICAL_STAFF: {
                    
                    break;
                }

                case User::TYPE_NURSING_STAFF: {
                    
                    break;
                }

                case User::TYPE_PATIENT: {
                    
                    break;
                }
            }
        }

        // Generar elementos de la navegación del menú de sesión de usuario.

        $userMenuBuffer = ''; 

        if ($sessionManager->isLoggedIn()) {
            $user = $sessionManager->getLoggedInUser();
            
            $fullName = $user->getFullName();

            $profileUrl = $app->getUrl() . '/self/profile/';
            
            switch ($user->getType()) {
                case User::TYPE_LAB_STAFF:
                    $userTypeTitle = 'lab';
                    break;
                case User::TYPE_MANAGEMENT_STAFF:
                    $userTypeTitle = 'gestión';
                    break;
                case User::TYPE_MEDICAL_STAFF:
                    $userTypeTitle = 'medicina';
                    break;
                case User::TYPE_NURSING_STAFF:
                    $userTypeTitle = 'enfermería';
                    break;
                case User::TYPE_PATIENT:
                    $userTypeTitle = 'paciente';
                    break;
            }

            $userMenuBuffer .= $viewManager->generateUserMenuItem('<a class="nav-link" href="' . $profileUrl . '">' . $fullName . '</a>');
            $userMenuBuffer .= $viewManager->generateUserMenuItem('<span class="badge bg-secondary rcs-user-type-badge">' . $userTypeTitle . '</span>');
            $userMenuBuffer .= $viewManager->generateUserMenuItem($logoutForm->getHtml());
        } else {
            $loginUrl = $app->getUrl() . '/auth/login/';

            $userMenuBuffer .= $viewManager->generateUserMenuItem("<a class=\"nav-link\" href=\"$loginUrl\">Iniciar sesión</a>", LoginView::class);
        }

        $filling = array(
            'app-name' => $app->getName(),
            'current-page-name' => $viewManager->getCurrentPageName(),
            'current-page-id' => $viewManager->getCurrentPageId(),
            'app-url' => $app->getUrl(),
            'cache-version' => (! $app->isDevMode()) ? '' : '?v=0.0.0' . time(),
            'main-menu-items' => $mainMenuBuffer,
            'user-menu-items' => $userMenuBuffer
        );

        $app->getViewManagerInstance()->renderTemplate(self::VIEW_RESOURCE_FILE, $filling);
    }
}

?>