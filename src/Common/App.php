<?php 

namespace Juancrrn\Reacsampler\Common;

use Juancrrn\Reacsampler\Common\Session;

use DateTime;
use Juancrrn\Reacsampler\Common\View\ViewManager;

/**
 * Inicialización y métodos de la aplicación.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class App
{
    
    /**
     * @var string      Instancia actual de la aplicación.
     */
    private static $instance;
    
    /**
     * @var Session     Instancia actual del gestor de sesión.
     */
    private $sessionInstance;
    
    /**
     * @var Controller  Instancia actual del controlador HTTP.
     */
    private $controllerInstance;

    /**
     * @var ViewManager Instancia actual del gestor de vistas.
     */
    private $viewManagerInstance;

    /**
     * @var \mysqli $dbConn Conexión de la instancia a la base de datos.
     */
    private $dbConn;

    /**
     * @var array $dbCredentials        Datos de conexión a la base de datos.
     */
    private $dbCredentials;

    /**
     * 
     * 
     * @var string $root                Directorio raíz de la instalación.
     * @var string $url                 URL pública de la instalación.
     * @var string $pathBase            Base de la URL para el controlador.
     * @var string $nombre              Nombre de la aplicación.
     */
    private $root;
    private $url;
    private $pathBase;
    private $name;

    /** 
     * @var string $default_password    Contraseña por defecto para los 
     *                                  usuarios creados.
     */
    private $defaultPassword;
    
    /**
     * @var bool $devMode               Indica si la aplicación esá en modo 
     *                                  desarrollo.
     */
    private $devMode;

    /**
     * 
     */
    private const VIEW_RESOURCES_PATH = 'resources/views';
    
    /**
     * Constructor. Al ser privado, asegura que solo habrá una única instancia
     * de la clase (patrón singleton).
     */
    private function __construct()
    {
    }

    /**
     * Evita que se pueda utilizar el operador clone.
     */
    public function __clone()
    {
        throw new \Exception("Cloning not allowed.");
    }

    /**
     * Evita que se pueda utilizar serialize().
     */
    public function __sleep()
    {
        throw new \Exception("Serializing not allowed.");
    }

    /**
     * Evita que se pueda utilizar unserialize().
     */
    public function __wakeup()
    {
        throw new \Exception("Deserializing not allowed.");
    }

    /**
     * Instanciar la aplicación.
     */
    public static function getSingleton()
    {
        if (! self::$instance instanceof self) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Inicializar la instancia.
     */
    public function init(
        array $dbCredentials,

        string $root,
        string $url,
        string $pathBase,
        string $name,

        string $defaultPassword,

        bool $devMode
    ): void
    {
        $this->dbConn = null;

        $this->dbCredentials = $dbCredentials;

        $this->root = $root;
        $this->url = $url;
        $this->pathBase = $pathBase;
        $this->name = $name;

        $this->defaultPassword = $defaultPassword;

        $this->devMode = $devMode;

        // Inicializar gestión de la sesión de usuario.
        $this->sessionInstance = new Session();
        $this->sessionInstance->init();

        // Inicializar la gestión del controlador HTTP.
        $this->controllerInstance = new Controller($pathBase);
        
        // Inicializar la gestión de vistas.
        $this->viewManagerInstance = new ViewManager(realpath($root . self::VIEW_RESOURCES_PATH));
    }

    /**
     * Inicia una conexión con la base de datos.
     */
    public function getDbConn() : \mysqli
    {
        if (! $this->dbConn) {
            $host = $this->dbCredentials["host"];
            $user = $this->dbCredentials["user"];
            $password = $this->dbCredentials["password"];
            $name = $this->dbCredentials["name"];

            //$driver = new \mysqli_driver();

            try {
                $this->dbConn = new \mysqli($host, $user, $password, $name);
            } catch (\mysqli_sql_exception $e) {
                throw new \Exception("Error al conectar con la base de datos.", 0, $e);
            }

            try {
                $this->dbConn->set_charset("utf8mb4");
            } catch (\mysqli_sql_exception $e) {
                throw new \Exception("Error al configurar la codificación de la base de datos.", 1);
            }
        }

        return $this->dbConn;
    }

    /*
     *
     * Getters de las propiedades de la instancia.
     * 
     */

    public function getSessionInstance(): Session
    {
        return $this->sessionInstance;
    }

    public function getControllerInstance(): Controller
    {
        return $this->controllerInstance;
    }

    public function getViewManagerInstance(): ViewManager
    {
        return $this->viewManagerInstance;
    }

    public function getRoot(): string
    {
        return $this->root;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPathBase(): string
    {
        return $this->pathBase;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDefaultPassword(): string
    {
        return $this->defaultPassword;
    }

    public function isDevMode(): bool
    {
        return $this->devMode;
    }
}

?>