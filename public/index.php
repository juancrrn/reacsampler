<?php

require_once __DIR__ . '/../config/init.php';

use Juancrrn\Reacsampler\Common\App;
use Juancrrn\Reacsampler\Common\View\Error\Error404View;
use Juancrrn\Reacsampler\Common\View\Home\HomeView;

$app = App::getSingleton();

$controller = $app->getControllerInstance();

$viewManager = $app->getViewManagerInstance();

/**
 * Vistas de inicio
 */

$controller->get('/?', function () use ($viewManager) {
    $viewManager->render(new HomeView);
});

/**
 * Vistas de usuarios de cualquier tipo excepto invitados
 */

// Inicio de sesión
$controller->get('/auth/login/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Restablecimiento de contraseña
$controller->get('/auth/reset/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Perfil propio
$controller->get('/self/profile/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

/**
 * Vistas de tipo de usuario personal de laboratorio (LabStaff)
 */

// Lista de pruebas (muestras) asignadas pendientes de procesar
$controller->get('/lab/tests/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Edición de una prueba (para añadir el resultado)
$controller->get('/lab/tests/([0-9]+)/edit/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});


/**
 * Vistas de tipo de usuario personal de gestión (ManagementStaff)
 */

// Lista de usuarios de todos los tipos
$controller->get('/manage/users/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Creación de un usuario en particular de tipo personal de laboratorio (LabStaff)
$controller->get('/manage/users/lab/create/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Edición de un usuario en particular de tipo personal de laboratorio (LabStaff)
$controller->get('/manage/users/lab/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Creación de un usuario en particular de tipo personal de gestión (ManagementStaff)
$controller->get('/manage/users/management/create/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Edición de un usuario en particular de tipo personal de gestión (ManagementStaff)
$controller->get('/manage/users/management/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Creación de un usuario en particular de tipo personal médico (MedicalStaff)
$controller->get('/manage/users/medical/create/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Edición de un usuario en particular de tipo personal médico (MedicalStaff)
$controller->get('/manage/users/medical/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Creación de un usuario en particular de tipo personal de enfermería (NursingStaff)
$controller->get('/manage/users/nursing/create/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Edición de un usuario en particular de tipo personal de enfermería (NursingStaff)
$controller->get('/manage/users/nursing/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Creación de un usuario en particular de tipo paciente (Patient)
$controller->get('/manage/users/patient/create/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Edición de un usuario en particular de tipo paciente (Patient)
$controller->get('/manage/users/patient/([0-9]+)/edit/', function (int $userId) use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Eliminar usuarios
// etc etc

// Lista de pruebas de todos los tipos -> No, para proteger la privacidad

/**
 * Vistas de tipo de usuario personal médico (MedicalStaff)
 */

// Perfil de un paciente y su lista de pruebas de todo tipo
$controller->get('/medical/patient/([0-9]+])/view/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Solicitud de una nueva prueba
$controller->get('/medical/tests/request/([0-9]+])/', function (int $userId) use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Consulta de una prueba en detalle (funcionalidad adicional)
$controller->get('/medical/tests/([0-9]+])/detail/', function (int $testId) use ($viewManager) {
    throw new Exception('Route not implemented.');
});

/**
 * Vistas de tipo de usuario personal de enfermería (NursingStaff)
 */

// Lista de pruebas asignadas pendientes de tomar muestra
$controller->get('/nursing/tests/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Edición de una prueba (para obtener el identificador y añadir la muestra)
$controller->get('/nursing/tests/([0-9]+])/sample/', function (int $testId) use ($viewManager) {
    throw new Exception('Route not implemented.');
});

/**
 * Vistas de tipo de usuario paciente (Patient)
 */

// Lista de pruebas propias
$controller->get('/patient/tests/', function () use ($viewManager) {
    throw new Exception('Route not implemented.');
});

// Detalle de una prueba propia (funcionalidad adicional)
$controller->get('/patient/tests/([0-9]+])/detail/', function (int $testId) use ($viewManager) {
    throw new Exception('Route not implemented.');
});

$controller->default(function () use ($viewManager) {
    $viewManager->render(new Error404View);
});

?>