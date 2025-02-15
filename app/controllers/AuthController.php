<?php
require_once '../config.php';
require_once '../app/models/User.php';

class AuthController {

    // Registration logic
    public function register() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize inputs
            $name     = trim($_POST['name']);
            $email    = trim($_POST['email']);
            $password = $_POST['password'];
            $role     = $_POST['role'];

            // Basic validation
            if(empty($name) || empty($email) || empty($password) || empty($role)){
                $_SESSION['error'] = "All fields are required.";
                header("Location: ?page=register");
                exit;
            }

            // Check if email is already registered
            if(User::findByEmail($email)){
                $_SESSION['error'] = "Email already registered.";
                header("Location: ?page=register");
                exit;
            }

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Create user instance and assign values
            $user = new User();
            $user->name     = $name;
            $user->email    = $email;
            $user->password = $hashedPassword;
            $user->role     = $role;

            if($user->save()){
                $_SESSION['success'] = "Registration successful. Please log in.";
                header("Location: ?page=login");
                exit;
            } else {
                $_SESSION['error'] = "Registration failed.";
                header("Location: ?page=register");
                exit;
            }
        } else {
            // If not POST, show the registration form
            include __DIR__ . '/../views/auth/register.php';
        }
    }

    // Login logic
    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email    = trim($_POST['email']);
            $password = $_POST['password'];

            if(empty($email) || empty($password)){
                $_SESSION['error'] = "Email and password are required.";
                header("Location: ?page=login");
                exit;
            }

            $user = User::findByEmail($email);
            if($user && password_verify($password, $user['password'])){
                // Store user data in session
                $_SESSION['user'] = $user;
                header("Location: ?page=home");
                exit;
            } else {
                $_SESSION['error'] = "Invalid credentials.";
                header("Location: ?page=login");
                exit;
            }
        } else {
            // If not POST, show the login form
            include __DIR__ . '/../views/auth/login.php';
        }
    }

    // Logout logic
    public function logout() {
        session_destroy();
        header("Location: ?page=home");
        exit;
    }
}
