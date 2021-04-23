<?php

namespace Juancrrn\Reacsampler\Domain\Test;

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\Tools;
use Juancrrn\Reacsampler\Domain\Repository;

class TestRepository implements Repository
{

    /**
     * @var \mysqli $db     Conexión a la base de datos.
     */
    protected $db;

    /**
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

    private function createModelFromMysql(object $mysqli_object): Test
    {
        /*
         * Convertir las fechas en formato \DateTime, excepto si son nulas (y
         * pueden serlo).
         */

        $requestDate =
            \DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT,
            $mysqli_object->request_date);

        $sampleDate =
            $mysqli_object->sample_date ?
            \DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT,
            $mysqli_object->sample_date) : null;
            
        $labRunDate =
            $mysqli_object->lab_run_date ?
            \DateTime::createFromFormat(Tools::MYSQL_DATETIME_FORMAT,
            $mysqli_object->lab_run_date) : null;

        return new Test(
            $mysqli_object->id,
            $mysqli_object->reference,
            $mysqli_object->type,
            $mysqli_object->patient_id,
            $mysqli_object->request_medical_staff_issuer_id,
            $requestDate,
            $mysqli_object->request_sample_type,
            $mysqli_object->sample_nursing_staff_taker_id,
            $mysqli_object->sample_type,
            $sampleDate,
            $mysqli_object->lab_run_lab_staff_runner_id,
            $labRunDate,
            $mysqli_object->lab_run_result
        );
    }

    public function save(): bool|int
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

    public function retrieveById(int $id): static
    {
        echo "Hello";
        // Comprobar el tipo de usuario y llamar al constructor correspondiente
        throw new \Exception('Not implemented');
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

?>