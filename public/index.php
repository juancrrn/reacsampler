<?php

require_once __DIR__ . '/../config/init.php';

use Juancrrn\Reacsampler\Common\App;

use Juancrrn\Reacsampler\Common\Controller\AnyTypeController;
use Juancrrn\Reacsampler\Common\Controller\DemoController;
use Juancrrn\Reacsampler\Common\Controller\GuestController;
use Juancrrn\Reacsampler\Common\Controller\LabStaffController;
use Juancrrn\Reacsampler\Common\Controller\ManagementStaffController;
use Juancrrn\Reacsampler\Common\Controller\MedicalStaffController;
use Juancrrn\Reacsampler\Common\Controller\NursingStaffController;
use Juancrrn\Reacsampler\Common\Controller\PatientController;

$controller = App::getSingleton()->getControllerInstance();

/**
 * Vistas de demostración o de generación de datos de prueba.
 */

(new DemoController($controller))->runRouting();

/**
 * Vistas de tipo de usuario invitado, es decir, cualquiera en general o
 * cualquiera que no haya iniciado sesión.
 */

(new GuestController($controller))->runRouting();

/**
 * Vistas de tipo de usuario que ha iniciado sesión, sea del tipo que sea.
 */

(new AnyTypeController($controller))->runRouting();

/**
 * Vistas de tipo de usuario personal de laboratorio (LabStaff)
 */

(new LabStaffController($controller))->runRouting();

/**
 * Vistas de tipo de usuario personal de gestión (ManagementStaff)
 */

(new ManagementStaffController($controller))->runRouting();

/**
 * Vistas de tipo de usuario personal médico (MedicalStaff)
 */

(new MedicalStaffController($controller))->runRouting();

/**
 * Vistas de tipo de usuario personal de enfermería (NursingStaff)
 */

(new NursingStaffController($controller))->runRouting();

/**
 * Vistas de tipo de usuario paciente (Patient)
 */

(new PatientController($controller))->runRouting();

/**
 * Vista por defecto (solo error 404)
 */

(new GuestController($controller))->runDefaultRouting();

?>