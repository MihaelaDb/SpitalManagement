<?php
class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;

    // Create and return a database connection
    public static function getDBConnection(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    // Save a new user to the database
    public function save(){
        $conn = self::getDBConnection();
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->name, $this->email, $this->password, $this->role);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    // Find a user by email
    public static function findByEmail($email){
        $conn = self::getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $user;
    }
}
