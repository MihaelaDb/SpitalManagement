<?php
class Appointment {
    public $id;
    public $patient_id;
    public $doctor_id;
    public $appointment_datetime;
    public $description;

    // Get a DB connection
    public static function getDBConnection(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Save a new appointment
    public function save(){
        $conn = self::getDBConnection();
        $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_datetime, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $this->patient_id, $this->doctor_id, $this->appointment_datetime, $this->description);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // Get appointments for a given patient (with doctor name)
    public static function getAppointmentsByPatient($patient_id){
        $conn = self::getDBConnection();
        $query = "SELECT a.*, u.name as doctor_name FROM appointments a
                  INNER JOIN users u ON a.doctor_id = u.id
                  WHERE a.patient_id = ? ORDER BY appointment_datetime DESC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointments = [];
        while($row = $result->fetch_assoc()){
            $appointments[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $appointments;
    }
}
