<?php

namespace Juancrrn\Reacsampler\Domain\User;

abstract class User
{

    /**
     * Constantes de tipos de usuario.
     * 
     * Realmente, deberían ser un enumerado, pero PHP no dispone, aún, de ese
     * tipo de datos.
     */
    public const TYPE_LAB_STAFF         = "user_type_lab_staff";
    public const TYPE_MANAGEMENT_STAFF  = "user_type_management_staff";
    public const TYPE_MEDICAL_STAFF     = "user_type_medical_staff";
    public const TYPE_NURSING_STAFF     = "user_type_nursing_staff";
    public const TYPE_PATIENT           = "user_type_patient";

    /**
     * Comprueba si el usuario es de un tipo.
     * 
     * @param string $testType  Tipo de usuario a comprobar, utilizando las
     *                          constantes de tipos definidas arriba.
     * 
     * @return bool
     */
    abstract function isType(string $testType): bool;
}

?>