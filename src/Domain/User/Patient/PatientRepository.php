<?php

namespace Juancrrn\Reacsampler\Domain\User\Patient;

use Exception;
use Juancrrn\Reacsampler\Common\Tools;
use Juancrrn\Reacsampler\Domain\User\UserRepository;

class PatientRepository extends UserRepository
{

    private static function createModelFromMysql(object $mysqli_object): Patient
    {
        $birthDate =
            \DateTime::createFromFormat(Tools::MYSQL_DATE_FORMAT,
            $mysqli_object->birth_date);

        $registrationDate =
            \DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT,
            $mysqli_object->registration_date);

        $lastLoginDate =
            $mysqli_object->last_login_date ?
            \DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT,
            $mysqli_object->last_login_date) : null;

        return new Patient(
            $mysqli_object->id,
            $mysqli_object->gov_id,
            $mysqli_object->type,
            $mysqli_object->first_name,
            $mysqli_object->last_name,
            $mysqli_object->phone_number,
            $mysqli_object->email_address,
            $birthDate,
            $registrationDate,
            $lastLoginDate,
            
            $mysqli_object->postal_address,
            $mysqli_object->cipa_code,
            $mysqli_object->csns_code,
            $mysqli_object->sex,
            $mysqli_object->gender_identity,
            $mysqli_object->pronouns
        );
    }

    /**
     * @requires $mysqli_object contiene un campo id.
     * @requires Ese id existe en la tabla correspondiente al tipo.
     */
    public function completeModel(object $mysqli_object): Patient
    {
        $query = <<< SQL
        SELECT
            postal_address,
            cipa_code,
            csns_code,
            sex,
            gender_identity,
            pronouns
        FROM
            users_type_patient
        WHERE
            id = ?
        LIMIT 1
        SQL;

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $mysqli_object->id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows != 1)
            throw new Exception('Row not found in specific type table.');
        
        $typeSpecificProperties = $result->fetch_object();
        $mergedObjects = (object) array_merge((array) $mysqli_object, (array) $typeSpecificProperties);

        $labStaffUser = self::createModelFromMysql($mergedObjects);
        
        $stmt->close();

        return $labStaffUser;
    }
}

?>