<?php

namespace Juancrrn\Reacsampler\Domain\Test;

class Test
{

    /**
     * Identificador interno.
     * 
     * @var int $id
     */
    private $id;

    /**
     * Referencia visible.
     * 
     * @var string $reference
     */
    private $reference;

    /**
     * En formato Juancrrn\Reacsampler\Common\Tools::TEST_TYPES.
     * 
     * @var string $type
     */
    private $type;

    /**
     * Identificador del usuario receptor de la prueba.
     * 
     * Usuario de tipo Juancrrn\Reacsampler\Domain\User\Patient\Patient.
     * 
     * @var int $patientId
     */
    private $patientId;

    /**
     * Identificador del usuario que solicita la prueba.
     * 
     * Usuario de tipo Juancrrn\Reacsampler\Domain\User\MedicalStaff
     * \MedicalStaff.
     * 
     * @var int $requestMedicalStaffIssuerId
     */
    private $requestMedicalStaffIssuerId;

    /**
     * Fecha y hora de petición de la prueba.
     * 
     * En formato Juancrrn\Reacsampler\Common\Tools::MYSQL_DATETIME_FORMAT.
     * 
     * @var \DateTime $requestDate
     */
    private $requestDate;

    /**
     * Tipo de muestra solicitado.
     * 
     * En formato Juancrrn\Reacsampler\Common\Tools::TEST_SAMPLE_TYPES.
     * 
     * @var string $requestSample_type
     */
    private $requestSampleType;

    /**
     * Identificador del usuario que toma la muestra.
     * 
     * Usuario de tipo Juancrrn\Reacsampler\Domain\User\NursingStaff
     * \NursingStaff.
     * 
     * Puede ser nulo si aún no se ha tomado la muestra.
     * 
     * @var null|int $sampleNursingStaffTakerId
     */
    private $sampleNursingStaffTakerId;

    /**
     * Tipo de la muestra.
     * 
     * En formato Juancrrn\Reacsampler\Common\Tools::TEST_SAMPLE_TYPES.
     * 
     * Puede ser nulo si aún no se ha tomado la muestra.
     * 
     * @var null|string $sampleType
     */
    private $sampleType;

    /**
     * Fecha y hora de la toma de la muestra.
     * 
     * En formato Juancrrn\Reacsampler\Common\Tools::MYSQL_DATETIME_FORMAT.
     * 
     * Puede ser nulo si aún no se ha tomado la muestra.
     * 
     * @var null|\DateTime $sampleDate
     */
    private $sampleDate;

    /**
     * Identificador del usuario que procesa la prueba en el laboratorio.
     * 
     * Usuario de tipo Juancrrn\Reacsampler\Domain\User\LabStaff\LabStaff.
     * 
     * Puede ser nulo si aún no se ha procesado en el laboratorio.
     * 
     * @var null|int $labRunLabStaffRunnerId
     */
    private $labRunLabStaffRunnerId;

    /**
     * Fecha y hora de procesamiento de la prueba en el laboratorio.
     * 
     * En formato Juancrrn\Reacsampler\Common\Tools::MYSQL_DATETIME_FORMAT.
     * 
     * Puede ser nulo si aún no se ha procesado en el laboratorio.
     * 
     * @var null|\DateTime $labRunDate
     */
    private $labRunDate;

    /**
     * Resultado de la prueba (positivo o negativo).
     * 
     * Puede ser nulo si aún no se ha procesado en el laboratorio.
     * 
     * @var null|bool $labRunResult
     */
    private $labRunResult;

    public function __constructor(
        int         $id,
        string      $reference,
        string      $type,
        int         $patientId,
        int         $requestMedicalStaffIssuerId,
        \DateTime   $requestDate,
        string      $requestSampleType,
        ?int        $sampleNursingStaffTakerId,
        ?string     $sampleType,
        ?\DateTime  $sampleDate,
        ?int        $labRunLabStaffRunnerId,
        ?\DateTime  $labRunDate,
        ?bool       $labRunResult
    )
    {
        $this->id                           = $id;
        $this->reference                    = $reference;
        $this->type                         = $type;
        $this->patientId                    = $patientId;
        $this->requestMedicalStaffIssuerId  = $requestMedicalStaffIssuerId;
        $this->requestDate                  = $requestDate;
        $this->requestSampleType            = $requestSampleType;
        $this->sampleNursingStaffTakerId    = $sampleNursingStaffTakerId;
        $this->sampleType                   = $sampleType;
        $this->sampleDate                   = $sampleDate;
        $this->labRunLabStaffRunnerId       = $labRunLabStaffRunnerId;
        $this->labRunDate                   = $labRunDate;
        $this->labRunResult                 = $labRunResult;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function getRequestMedicalStaffIssuerId(): int
    {
        return $this->requestMedicalStaffIssuerId;
    }

    public function getRequestDate(): \DateTime
    {
        return $this->requestDate;
    }

    public function getRequestSampleType(): string
    {
        return $this->requestSampleType;
    }

    public function getSampleNursingStaffTakerId(): null|int
    {
        return $this->sampleNursingStaffTakerId;
    }

    public function getSampleType(): null|string
    {
        return $this->sampleType;
    }

    public function getSampleDate(): null|\DateTime
    {
        return $this->sampleDate;
    }

    public function getLabRunLabStaffRunnerId(): null|int
    {
        return $this->labRunLabStaffRunnerId;
    }

    public function getLabRunDate(): null|\DateTime
    {
        return $this->labRunDate;
    }

    public function getLabRunResult(): null|bool
    {
        return $this->labRunResult;
    }

}

?>