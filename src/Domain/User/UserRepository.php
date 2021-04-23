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

    public function update(): bool|int
    {
        throw new \Exception('Not implemented');
    }

    public function findById(int $id): bool|int
    {
        throw new \Exception('Not implemented');
    }

    public function findByNif(string $nif): bool|int
    {
        throw new \Exception('Not implemented');
    }

    public function retrieveById(int $id)/*: static*/
    {
        $query = <<< SQL
        SELECT 
            id,
            gov_id,
            type,
            first_name,
            last_name,
            phone_number,
            email_address,
            hashed_password,
            birth_date,
            registration_date,
            last_login_date
        FROM
            users
        WHERE
            id = ?
        LIMIT 1
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $user = $resultado->fetch_object();

        var_dump($user);

        // Comprobar tipo de usuario
        // Pasar a la subclase repositorio para que lo complete
        // Que devuelva un objeto del tipo correspondiente

        switch ($user->type) {
            case User::TYPE_LAB_STAFF:
                break;
            case User::TYPE_MANAGEMENT_STAFF:
                break;
            case User::TYPE_MEDICAL_STAFF:
                break;
            case User::TYPE_NURSING_STAFF:
                break;
            case User::TYPE_PATIENT:
                break;
            default:
                throw new \OutOfBoundsException('Invalid user type.');
        }

        //$usuario = Usuario::fromMysqlFetch($resultado->fetch_object());
        $stmt->close();
        
        //return $usuario;


        //echo "Hello";
        // Comprobar el tipo de usuario y llamar al constructor correspondiente
        //throw new \Exception('Not implemented');
    }

    public function retrieveAll(): array
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

    public function deleteById(int $id): bool
    {
        throw new \Exception('Not implemented');
    }
}