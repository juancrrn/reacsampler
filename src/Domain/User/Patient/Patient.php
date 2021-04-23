<?php

namespace Juancrrn\Reacsampler\Domain\User\Patient;

use Juancrrn\Reacsampler\Domain\User\User;

class Patient extends User
{

    /**
     * @var string $postalAddress
     */
    private $postalAddress;

    /**
     * @var string $cipaCode
     */
    private $cipaCode;

    /**
     * @var string $csnsCode
     */
    private $csnsCode;

    /**
     * @var string $sex
     */
    private $sex;

    /**
     * @var string $genderIdentity
     */
    private $genderIdentity;

    /**
     * @var string $pronouns
     */
    private $pronouns;

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
        string      $postalAddress,
        string      $cipaCode,
        string      $csnsCode,
        string      $sex,
        string      $genderIdentity,
        string      $pronouns
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

        $this->postalAddress    = $postalAddress;
        $this->cipaCode         = $cipaCode;
        $this->csnsCode         = $csnsCode;
        $this->sex              = $sex;
        $this->genderIdentity   = $genderIdentity;
        $this->pronouns         = $pronouns;
    }

    function isType(string $testType): bool
    {
        return $testType == User::TYPE_PATIENT ? true : false;
    }

    public function getPostalAddress(): string
    {
        return $this->postalAddress;
    }

    public function getCipaCode(): string
    {
        return $this->cipaCode;
    }

    public function getCsnsCode(): string
    {
        return $this->csnsCode;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function getGenderIdentity(): string
    {
        return $this->genderIdentity;
    }

    public function getPronouns(): string
    {
        return $this->pronouns;
    }

}

?>