<?php
require_once '../config.php';
require_once '../app/models/Appointment.php';

class AppointmentController {

    // List appointments based on role:
    // - Doctors see all appointments.
    // - Normal users see only their own and can create new ones.
    public function listAppointments(){
        if(!isset($_SESSION['user'])){
            header("Location: ?page=login");
            exit;
        }
        $user = $_SESSION['user'];
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if($user['role'] === 'doctor'){
            // Retrieve all appointments with patient and doctor names
            $query = "SELECT a.*, p.name as patient_name, d.name as doctor_name 
                      FROM appointments a 
                      JOIN users p ON a.patient_id = p.id 
                      JOIN users d ON a.doctor_id = d.id 
                      ORDER BY appointment_datetime DESC";
            $result = $conn->query($query);
            $appointments = [];
            while($row = $result->fetch_assoc()){
                $appointments[] = $row;
            }
            // Doctors don't need the creation form
            $doctors = [];
        } else {
            // Normal user: only their appointments
            $query = "SELECT a.*, d.name as doctor_name 
                      FROM appointments a 
                      JOIN users d ON a.doctor_id = d.id 
                      WHERE a.patient_id = ? 
                      ORDER BY appointment_datetime DESC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $appointments = [];
            while($row = $result->fetch_assoc()){
                $appointments[] = $row;
            }
            $stmt->close();
            
            // Also fetch available doctors for appointment creation
            $doctors = [];
            $result2 = $conn->query("SELECT id, name FROM users WHERE role='doctor'");
            while($row = $result2->fetch_assoc()){
                $doctors[] = $row;
            }
        }
        $conn->close();
        
        include '../app/views/appointments/manage.php';
    }

    // Create appointment (only for normal users)
    public function createAppointment(){
        if(!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'doctor'){
            header("Location: ?page=login");
            exit;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $appointment_datetime = $_POST['appointment_datetime'];
            $description = trim($_POST['description']);
            $doctor_id = $_POST['doctor_id'];

            $appointment = new Appointment();
            $appointment->patient_id = $_SESSION['user']['id'];
            $appointment->doctor_id = $doctor_id;
            $appointment->appointment_datetime = $appointment_datetime;
            $appointment->description = $description;

            if($appointment->save()){
                $_SESSION['success'] = "Appointment created successfully.";
            } else {
                $_SESSION['error'] = "Failed to create appointment.";
            }
            header("Location: ?page=appointments");
            exit;
        }
    }

    // Edit appointment (only for doctors)
    public function editAppointment(){
        if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'doctor'){
            header("Location: ?page=login");
            exit;
        }
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Process update
            $id = $_POST['id'];
            $appointment_datetime = $_POST['appointment_datetime'];
            $description = trim($_POST['description']);
            $doctor_id = $_POST['doctor_id'];
            $patient_id = $_POST['patient_id'];

            $stmt = $conn->prepare("UPDATE appointments SET appointment_datetime = ?, description = ?, doctor_id = ?, patient_id = ? WHERE id = ?");
            $stmt->bind_param("ssiii", $appointment_datetime, $description, $doctor_id, $patient_id, $id);
            if($stmt->execute()){
                $_SESSION['success'] = "Appointment updated successfully.";
            } else {
                $_SESSION['error'] = "Failed to update appointment.";
            }
            $stmt->close();
            $conn->close();
            header("Location: ?page=appointments");
            exit;
        } else {
            // GET: load appointment data and display edit form
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM appointments WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $appointment = $result->fetch_assoc();
            $stmt->close();

            // Get doctors list for the dropdown
            $doctors = [];
            $result2 = $conn->query("SELECT id, name FROM users WHERE role='doctor'");
            while($row = $result2->fetch_assoc()){
                $doctors[] = $row;
            }
            // Get patients list for the dropdown
            $patients = [];
            $result3 = $conn->query("SELECT id, name FROM users WHERE role='user'");
            while($row = $result3->fetch_assoc()){
                $patients[] = $row;
            }
            $conn->close();
            include '../app/views/appointments/edit.php';
        }
    }

    // Delete appointment (only for doctors)
    public function deleteAppointment(){
        if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'doctor'){
            header("Location: ?page=login");
            exit;
        }
        $id = $_GET['id'];
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            $_SESSION['success'] = "Appointment deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete appointment.";
        }
        $stmt->close();
        $conn->close();
        header("Location: ?page=appointments");
        exit;
    }
}
