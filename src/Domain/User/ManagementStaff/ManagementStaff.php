<?php

namespace Juancrrn\Reacsampler\Domain\User\ManagementStaff;

use Juancrrn\Reacsampler\Domain\User\User;

class ManagementStaff extends User
{

    /**
     * Area.
     * 
     * @var string $area
     */
    private $area;

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
        string      $area,
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

        $this->area             = $area;
        $this->collegiateNumber = $collegiateNumber;
    }

    function isType(string $testType): bool
    {
        return $testType == User::TYPE_MANAGEMENT_STAFF ? true : false;
    }

    public function getArea(): string
    {
        return $this->area;
    }
}

?>