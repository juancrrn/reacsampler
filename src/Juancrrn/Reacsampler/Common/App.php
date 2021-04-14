<?php 

namespace Juancrrn\Reacsampler\Common;

use DateTime;

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
     * @var string Instancia actual de la aplicación.
     */
    private static $instance;
    
    /**
     * @var Session Instancia actual del gestor de sesión.
     */
    private $sessionInstance;
    
    /**
     * @var Controller Instancia actual del controlador HTTP.
     */
    private $controllerInstance;

    /**
     * @var string $dbConn              Conexión de la instancia a la base 
     *                                  de datos.
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
        //$this->sessionInstance = new Session();

        //$this->sessionInstance->init();

        $this->controllerInstance = new Controller($pathBase);
    }

    /**
     * Inicia una conexión con la base de datos.
     */
    public function bbddCon() : \mysqli
    {
        if (! $this->bbdd_con) {
            $host = $this->bbdd_datos["host"];
            $user = $this->bbdd_datos["user"];
            $password = $this->bbdd_datos["password"];
            $name = $this->bbdd_datos["name"];

            $driver = new \mysqli_driver();

            try {
                $this->bbdd_con = new \mysqli($host, $user, $password, $name);
            } catch (\mysqli_sql_exception $e) {
                throw new \Exception("Error al conectar con la base de datos.", 0, $e);
            }

            try {
                $this->bbdd_con->set_charset("utf8mb4");
            } catch (\mysqli_sql_exception $e) {
                throw new \Exception("Error al configurar la codificación de la base de datos.", 1);
            }
        }

        return $this->bbdd_con;
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

    public function getRoot(): string
    {
        return $this->root;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getpathBase(): string
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