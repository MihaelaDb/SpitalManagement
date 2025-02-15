<?php
require_once '../config.php';
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        include '../app/views/home.php';
        break;
    case 'register':
        require_once '../app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->register();
        break;
    case 'login':
        require_once '../app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->login();
        break;
    case 'logout':
        require_once '../app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->logout();
        break;
    case 'appointments':
        require_once '../app/controllers/AppointmentController.php';
        $appointmentController = new AppointmentController();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Normal user appointment creation
            $appointmentController->createAppointment();
        } else {
            $appointmentController->listAppointments();
        }
        break;
    case 'edit_appointment':
        require_once '../app/controllers/AppointmentController.php';
        $appointmentController = new AppointmentController();
        $appointmentController->editAppointment();
        break;
    case 'delete_appointment':
        require_once '../app/controllers/AppointmentController.php';
        $appointmentController = new AppointmentController();
        $appointmentController->deleteAppointment();
        break;
    case 'documentation':
        include '../app/views/documentation.php';
        break;
    default:
        echo "Page not found.";
        break;
}
