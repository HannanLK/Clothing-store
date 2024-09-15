<?php

class LoginController extends Controller {

    public function index() {
        // Render the login view
        $this->renderView('auth/login');
    }

    // Handle user login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get username and password from POST request
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));

            // Load the user model
            $userModel = $this->model('UserModel');

            // Authenticate the user
            $user = $userModel->authenticate($username, $password);

            if ($user) {
                // Set session data for logged-in user
                $_SESSION['user_id'] = $user['user_id'];  
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header('Location: /clothing-store/public/admin/dashboard');
                } else {
                    header('Location: /clothing-store/public');
                }
            } else {
                // Invalid credentials, reload login with error
                $this->renderView('auth/login', ['error' => 'Invalid username or password']);
            }
        }
    }

    // Handle user logout
    public function logout() {
        session_destroy();
        header('Location: /clothing-store/public/login');
    }
}
