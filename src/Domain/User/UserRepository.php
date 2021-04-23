<?php

namespace Juancrrn\Reacsampler\Domain\User;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Domain\Repository;
use Juancrrn\Reacsampler\Domain\User\LabStaff\LabStaffRepository;
use Juancrrn\Reacsampler\Domain\User\Patient\PatientRepository;

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

    private function switchAndCompleteType(object $mysqli_object)
    {
        switch ($mysqli_object->type) {
            case User::TYPE_LAB_STAFF:
                //return (new LabStaffRepository($this->db))->completeModel($mysqli_object);
            case User::TYPE_MANAGEMENT_STAFF:
                break;//return (new ManagementStaffRepository($this->db))->completeModel($mysqli_object);
            case User::TYPE_MEDICAL_STAFF:
                break;//return (new MedicalStaffRepository($this->db))->completeModel($mysqli_object);
            case User::TYPE_NURSING_STAFF:
                break;//return (new NursingStaffRepository($this->db))->completeModel($mysqli_object);
            case User::TYPE_PATIENT:
                return (new PatientRepository($this->db))->completeModel($mysqli_object);
            default:
                throw new \OutOfBoundsException('Invalid user type.');
        }
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
        
        $mysqli_object = $resultado->fetch_object();

        $user = $this->switchAndCompleteType($mysqli_object);

        $stmt->close();

        return $user;
    }

    public function retrieveAll(): array
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
        LIMIT 1
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $users = array();

        while ($mysqli_object = $resultado->fetch_object()) {
            $users[] = $this->switchAndCompleteType($mysqli_object);
        }

        $stmt->close();

        return $users;
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