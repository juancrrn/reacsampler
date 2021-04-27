<?php

namespace Juancrrn\Reacsampler\Common\Controller;

use Exception;
use Juancrrn\Reacsampler\Common\App;

/**
 * Vistas de tipo de usuario personal de gestión (ManagementStaffController)
 * 
 * @package reacsampler
 *
 * @author juancrrn
 *
 * @version 0.0.1
 */

class ManagementStaffController implements ControllerModel
{

    private $controllerInstance;

    public function __construct(Controller $controllerInstance)
    {
        $this->controllerInstance = $controllerInstance;
    }

    public function runRouting(): void
    {
        $viewManager = App::getSingleton()->getViewManagerInstance();
        
        // Lista de usuarios de todos los tipos
        $this->controllerInstance->get('/manage/users/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Creación de un usuario en particular de tipo personal de laboratorio (LabStaff)
        $this->controllerInstance->get('/manage/users/lab/create/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Edición de un usuario en particular de tipo personal de laboratorio (LabStaff)
        $this->controllerInstance->get('/manage/users/lab/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Creación de un usuario en particular de tipo personal de gestión (ManagementStaff)
        $this->controllerInstance->get('/manage/users/management/create/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Edición de un usuario en particular de tipo personal de gestión (ManagementStaff)
        $this->controllerInstance->get('/manage/users/management/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Creación de un usuario en particular de tipo personal médico (MedicalStaff)
        $this->controllerInstance->get('/manage/users/medical/create/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Edición de un usuario en particular de tipo personal médico (MedicalStaff)
        $this->controllerInstance->get('/manage/users/medical/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Creación de un usuario en particular de tipo personal de enfermería (NursingStaff)
        $this->controllerInstance->get('/manage/users/nursing/create/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Edición de un usuario en particular de tipo personal de enfermería (NursingStaff)
        $this->controllerInstance->get('/manage/users/nursing/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Creación de un usuario en particular de tipo paciente (Patient)
        $this->controllerInstance->get('/manage/users/patient/create/', function () use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Edición de un usuario en particular de tipo paciente (Patient)
        $this->controllerInstance->get('/manage/users/patient/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
            throw new Exception('Route declared but not implemented.');
        });

        // Eliminar usuarios
        // etc etc

        // Lista de pruebas de todos los tipos -> No, para proteger la privacidad
    }
}

?>