<?php

namespace Juancrrn\Reacsampler\Domain\User\LabStaff;

use Juancrrn\Reacsampler\Domain\User\User;

class LabStaff extends User
{

    /**
     * Especialidad (área o campo).
     * 
     * @var string $field
     */
    private $field;

    /**
     * Número de colegiación.
     * 
     * @var string $collegiateNumber
     */
    private $collegiateNumber;

    public function __construct(
        int         $id,
        string      $govId,
        string      $type,
        string      $firstName,
        string      $lastName,
        string      $phoneNumber,
        string      $emailAddress,
        \DateTime   $birthDate,
        \DateTime   $registrationDate,
        ?\DateTime  $lastLoginDate,
        string      $field,
        string      $collegiateNumber
    )
    {
        parent::__construct(
            $id,
            $govId,
            $type,
            $firstName,
            $lastName,
            $phoneNumber,
            $emailAddress,
            $birthDate,
            $registrationDate,
            $lastLoginDate
        );

        $this->field            = $field;
        $this->collegiateNumber = $collegiateNumber;
    }

    function isType(string $testType): bool
    {
        return $testType == User::TYPE_LAB_STAFF ? true : false;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getCollegiateNumber(): string
    {
        return $this->collegiateNumber;
    }
}

?>