<?php

namespace Juancrrn\Reacsampler\Common;

use Juancrrn\Reacsampler\Common\HTTP;

/**
 * Controla las peticiones HTTP. Modelo front controller.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class Controller
{

    private $pathBase = '';

    public function __construct(string $pathBase)
    {
        $this->pathBase = $pathBase;
    }

    /**
     * Procesa una petición sin importar el método (GET, POST, etc.).
     * 
     * @param string $route
     * @param callable $handler
     */
    public function any(string $route, callable $handler): void
    {
        self::processRequest($route, $handler);
    }

    /**
     * Procesa una petición GET.
     * 
     * @param string $route
     * @param callable $handler
     */
    public function get(string $route, callable $handler): void
    {
        if (HTTP::isRequestMethod(HTTP::METHOD_GET))
            self::processRequest($route, $handler);
    }

    /**
     * Procesa una petición POST.
     * 
     * @param string $route
     * @param callable $handler
     */
    public function post(string $route, callable $handler): void
    {
        if (HTTP::isRequestMethod(HTTP::METHOD_POST))
            self::processRequest($route, $handler);
    }

    /**
     * Procesa una petición PUT.
     * 
     * @param string $route
     * @param callable $handler
     */
    public function put(string $route, callable $handler): void
    {
        if (HTTP::isRequestMethod(HTTP::METHOD_PUT))
            self::processRequest($route, $handler);
    }

    /**
     * Procesa una petición DELETE.
     * 
     * @param string $route
     * @param callable $handler
     */
    public function delete(string $route, callable $handler): void
    {
        if (HTTP::isRequestMethod(HTTP::METHOD_DELETE))
            self::processRequest($route, $handler);
    }

    /**
     * Procesa una petición PATCH.
     * 
     * @param string $route
     * @param callable $handler
     */
    public function patch(string $route, callable $handler): void
    {
        if (HTTP::isRequestMethod(HTTP::METHOD_PATCH))
            self::processRequest($route, $handler);
    }

    /**
     * Procesa una petición en general.
     * 
     * @param string $route
     * @param callable $handler
     */
    public function processRequest(string $route, callable $handler): void
    {
        $matches = array();

        if (HTTP::matchesRequestUri($this->pathBase, $route, $matches)) {
            echo call_user_func_array($handler, $matches);
            
            die();
        }
    }

    /**
     * Se ejecuta cuando no se ha ejecutado ningún controlador anteriormente.
     */
    public function default(callable $handler): void
    {
        http_response_code(404);
        
        echo call_user_func($handler);
    }
}

?>