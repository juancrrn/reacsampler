<?php

namespace Juancrrn\Reacsampler\Domain\User;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Domain\Repository;
use Juancrrn\Reacsampler\Domain\User\LabStaff\LabStaffRepository;
use Juancrrn\Reacsampler\Domain\User\ManagementStaff\ManagementStaffRepository;
use Juancrrn\Reacsampler\Domain\User\MedicalStaff\MedicalStaffRepository;
use Juancrrn\Reacsampler\Domain\User\NursingStaff\NursingStaffRepository;
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

    public function findByGovId(string $testGovId): bool|int
    {
        $testGovId = mb_strtoupper($testGovId);

        $query = <<< SQL
        SELECT 
            id
        FROM
            users
        WHERE
            gov_id = ?
        LIMIT 1
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $testGovId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows != 1) {
            $return = false;
        } else {
            $return = $result->fetch_object()->id;
        }

        $stmt->close();

        return $return;
    }

    private function switchAndCompleteType(object $mysqli_object)
    {
        switch ($mysqli_object->type) {
            case User::TYPE_LAB_STAFF:
                return (new LabStaffRepository($this->db))->completeModel($mysqli_object);
            case User::TYPE_MANAGEMENT_STAFF:
                return (new ManagementStaffRepository($this->db))->completeModel($mysqli_object);
            case User::TYPE_MEDICAL_STAFF:
                return (new MedicalStaffRepository($this->db))->completeModel($mysqli_object);
            case User::TYPE_NURSING_STAFF:
                return (new NursingStaffRepository($this->db))->completeModel($mysqli_object);
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

    public function retrieveJustHashedPasswordById(int $id): string
    {
        $query = <<< SQL
        SELECT
            hashed_password
        FROM
            users
        WHERE
            id = ?
        LIMIT 1
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        
        $hashedPassword = $result->fetch_object()->hashed_password;

        $stmt->close();

        return $hashedPassword;
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
            birth_date,
            registration_date,
            last_login_date
        FROM
            users
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