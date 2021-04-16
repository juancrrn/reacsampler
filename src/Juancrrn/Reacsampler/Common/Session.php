<?php

namespace Juancrrn\Reacsampler\Common;

use Juancrrn\Reacsampler\Domain\User\User;
use Juancrrn\Reacsampler\Common\HTTP;
use Awsw\Gesi\Vistas\Vista;

/**
 * Métodos de sesión de usuario.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class Session
{
    // Valor de $_SESSION donde se almacena la información de sesión.
    const SESSION_NAME = "reacsampler_session";

    // Usuario que ha iniciado sesión.
    private static $loggedInUser = null;
    
    public function __construct()
    {
    }

    /**
     * Inicializa la gestión de la sesión de usuario.
     */
    public function init(): void
    {
        session_start();
        
        if (
            isset($_SESSION[self::SESSION_NAME]) &&
            is_object($_SESSION[self::SESSION_NAME]) &&
            $_SESSION[self::SESSION_NAME] instanceof User
        ) {
            $this->loggedInUser = $_SESSION[self::SESSION_NAME];
        }
    }

    /**
     * Inicia la sesión de un usuario.
     *
     * @requires No hay ninguna sesión ya iniciada.
     */
    public function doLogIn(User $user): void
    {
        // Actualizamos la última vez que el usuario inició sesión a ahora.
        // $user->updateLastSession();

        // Por seguridad, forzamos que se genere una nueva cookie de sesión por 
        // si la han capturado antes de hacer login.
        session_regenerate_id(true);

        $this->loggedInUser = $user;
        $_SESSION[self::SESSION_NAME] = $user;
    }

    /**
     * Cierra la sesión de un usuario.
     */
    public function doLogOut(): void
    {
        $this->loggedInUser = null;
        unset($_SESSION[self::SESSION_NAME]);

        session_destroy();

        session_start();
    }

    /**
     * Comprueba si la sesión está iniciada. Para ello, simplemente comprueba 
     * si self::$loggedInUser no es nula.
     */
    public function isLoggedIn(): bool
    {
        return ! is_null($this->loggedInUser);
    }

    /**
     * Devuelve el usuario que ha iniciado sesión.
     *
     * @requires Que haya una sesión iniciada.
     */
    public function getLoggedInUser() : User
    {
        return $this->loggedInUser;
    }

    /**
     * Requiere que haya una sesión iniciada para acceder al contenido.
     * En caso de que no haya ninguna sesión iniciada, redirige al inicio de
     * sesión.
     * 
     * @param bool $api Indica si se está utilizano el método en la API, por lo 
     *                  que, en lugar de redirigir, debería mostrar un error 
     *                  HTTP.
     */
    public function requireLoggedIn($api = false): void
    {
        if (! $this->isLoggedIn()) {
            if (! $api) {
                ddl(null, null);
                //Vista::encolaMensajeError('Necesitas haber iniciado sesión para acceder a este contenido.', '/sesion/iniciar/');
            } else {
                ddl(null, null);
                //HTTP::apiRespondError(401, array('No autenticado.')); // HTTP 401 Unauthorized (unauthenticated).
            }
        }
    }

    /**
     * Requiere que NO haya una sesión iniciada para acceder al contenido.
     * En caso de que haya alguna sesión iniciada, redirige a inicio.
     * 
     * @param bool $api Indica si se está utilizano el método en la API, por lo 
     *                  que, en lugar de redirigir, debería mostrar un error 
     *                  HTTP.
     */
    public function requireNotLoggedIn($api = false): void
    {
        if ($this->isLoggedIn()) {
            if (! $api) {
                ddl(null, null);
                //Vista::encolaMensajeError('No puedes acceder a esta página habiendo iniciado sesión.', '');
            } else {
                ddl(null, null);
                //HTTP::apiRespondError(409, array('No debería estar autenticado.')); // HTTP 409 Conflict.
            }
        }
    }

    /**
     * Requiere que haya una sesión iniciada de un usuario de tipo específico.
     * 
     * @param string $testType  Tipo de usuario especificado. Se deben utilizar
     *                          las constantes de tipo definidas en la parte
     *                          superior de la clase Domain\User\User.
     * @param bool $negate      Permite negar el tipo de usuario especificado.
     * @param bool $api         Indica si se está utilizano el método en la API,
     *                          por lo que, en lugar de redirigir, debería
     *                          mostrar un error HTTP.
     */
    public function requireLoggedInType(string $testType, ?bool $negate = false, ?bool $api = false): void
    {
        $this->requireLoggedIn($api);

        if ($this->getLoggedInUser()->isType($testType) == $negate) {
            if (! $api) {
                ddl(null, null);
                //Vista::encolaMensajeError('No tienes permisos suficientes para acceder a este contenido.', '');
            } else {
                ddl(null, null);
                //HTTP::apiRespondError(403, array('No autorizado.'));
            }
        }
    }
}
?>