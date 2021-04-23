<?php

namespace Juancrrn\Reacsampler\Domain\User;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Domain\Repository;

class UserRepository implements Repository
{

    /**
     * TODO
     * @var \mysqli $db     Conexión a la base de datos.
     */
    protected $db;

    /**
     * TODO
     * @var int $id         Identificador en la base de datos.
     */
    protected $id;

    /**
     * Constructor.
     * 
     * @param \mysqli $db   Conexión a la base de datos.
     */
    public function __construct(\mysqli $db)
    {
        $this->db = App::getSingleton()->getDbConn();
    }

    public function save(): bool|int
    {
        throw new \Exception('Not implemented');
    }

    public static function findById(int $id): bool|int
    {
        throw new \Exception('Not implemented');
    }

    public static function findByNif(string $nif): bool|int
    {
        throw new \Exception('Not implemented');
    }

    public static function retrieveById(int $id): static
    {
        echo "Hello";
        // Comprobar el tipo de usuario y llamar al constructor correspondiente
        throw new \Exception('Not implemented');
    }

    public static function retrieveAll(): array
    {
        throw new \Exception('Not implemented');
    }

    public function verifyConstraints(): bool|array
    {
        throw new \Exception('Not implemented');
    }

    public function delete(): bool
    {
        throw new \Exception('Not implemented');
    }

    public static function deleteById(int $id): bool
    {
        throw new \Exception('Not implemented');
    }
}