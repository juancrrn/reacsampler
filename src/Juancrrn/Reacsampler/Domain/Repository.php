<?php

namespace Juancrrn\Reacsampler\Domain;

/**
 * Clase abstracta para objetos que implementan el patrón repositorio.
 * 
 * El tipo "static" en los comentarios hace referencia a la clase que 
 * implementará la interfaz.
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

interface Repository
{

    /**
     * TODO
     * @var \mysqli $db     Conexión a la base de datos.
     */
    //protected $db;

    /**
     * TODO
     * @var int $id         Identificador en la base de datos.
     */
    //protected $id;

    /**
     * Constructor.
     * 
     * @param \mysqli $db   Conexión a la base de datos.
     */
    //public function __construct(\mysqli $db)
    //{
    //    $this->db = $db;
    //}

    /**
     * Actualiza o inserta el objeto en la base de datos, según si tiene o no
     * valor en la propiedad $id.
     * 
     * @param static $this Objeto a actualizar o insertar.
     * 
     * @return bool|int     True si se ha actualizado correctamente, false si
     *                      ha habido algún problema y, en el caso de inserción,
     *                      el identificador del objeto insertado.
     */
    public function save(): bool|int;

    /**
     * Recoge un objeto de la base de datos.
     * 
     * @param int $id Identificador del objeto.
     * 
     * @return bool|static Objeto o false si no existe.
     */
    public static function findById(int $id): bool|static;

    /**
     * Recoge todos los objetos de la base de datos.
     * 
     * @return array Lista con todos los objetos.
     */
    public static function findAll(): array;

    /**
     * Comprueba si un objeto se puede eliminar, es decir, que no está 
     * referenciado como clave ajena en otra tabla.
     * 
     * @requires      El objeto existe.
     * 
     * @param int $id Identificador del objeto.
     * 
     * @return array  En caso de haberlas, devuelve un array con los nombres de 
     *                las tablas donde hay referencias al objeto. Si no las 
     *                hay, devuelve un array vacío.
     */
    public static function dbCompruebaRestricciones(int $id): array;

    /*
     *
     * Operaciones DELETE.
     *  
     */

    /**
     * Elimina un objeto de la base de datos.
     * 
     * @requires      El objeto existe.
     * 
     * @param int $id Identificador del objeto.
     * 
     * @return bool   Resultado de la ejecución de la sentencia.
     */
    public static function dbEliminar(int $id): bool;
}

?>