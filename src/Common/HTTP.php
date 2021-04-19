<?php

namespace Juancrrn\Reacsampler\Common;

/**
 * Funciones auxiliares de HTTP.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class HTTP
{

    /**
     * HTTP request methods, according to
     * https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods.
     */

    /**
     * The GET method requests a representation of the specified resource.
     * Requests using GET should only retrieve data.
     */
    public const METHOD_GET = 'GET';

    /**
     * The POST method is used to submit an entity to the specified resource,
     * often causing a change in state or side effects on the server.
     */
    public const METHOD_POST = 'POST';

    /**
     * The PUT method replaces all current representations of the target
     * resource with the request payload.
     */
    public const METHOD_PUT = 'PUT';

    /**
     * The DELETE method deletes the specified resource.
     */
    public const METHOD_DELETE = 'DELETE';
    
    /**
     * The PATCH method is used to apply partial modifications to a resource.
     */
    public const METHOD_PATCH = 'PATCH';

    /**
     * Devuelve el método de petición HTTP.
     * 
     * @return string
     */
    public static function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Comprueba si el método de petición HTTP es el especificado.
     * 
     * @param string $testRequestMethod
     * 
     * @return bool
     */
    public static function isRequestMethod(string $testRequestMethod): bool
    {
        return $_SERVER['REQUEST_METHOD'] == $testRequestMethod;
    }

    /**
     * Comprueba si una cadena de texto (ruta) coincide con la URI de la
     * petición HTTP.
     * 
     * @param string $base      Base de la URL.
     * @param string $testRoute Ruta a comprobar. Pueden especificarse
     *                          parámetros o variables mediante grupos en la
     *                          expresión regular, utilizando paréntesis.
     * @param array $matches    Array en el que depositar los resultados de los
     *                          parámetros, si se especificaron y se encontró
     *                          alguno.
     * 
     * @return bool             True si coincide, false en caso contrario.
     */
    public static function matchesRequestUri(string $urlBase, string $testRoute, array &$matches): bool
    {
        /**
         * # al principio y al final son delimitadores de la expresión regular.
         *
         * ^ y $ son metacaracteres de expresiones regulares que se utilizan como
         * anclas de inicio y fin, respectivamente.
         */

        $getParamsRegEx = '(\?.*)?';
        
        if (preg_match('#^' . $urlBase . $testRoute . $getParamsRegEx . '$#', $_SERVER['REQUEST_URI'], $matches) == 1) {
            array_shift($matches);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Genera una respuesta HTTP con datos JSON y un código estado HTTP, y para 
     * la ejecución del script
     * 
     * @param int   $httpCode HTTP status code
     * @param array $messages Messages to send in the response
     */
    public static function apiRespondError(int $httpCode, array $messages): void
    {
        $errorData = array(
            'status' => 'error',
            'error' => $httpCode,
            'messages' => $messages
        );

        http_response_code($httpCode);

        header('Content-Type: application/json; charset=utf-8');
        
        echo json_encode($errorData);
        
        die();
    }
}

?>