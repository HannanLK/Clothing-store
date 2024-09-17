<?php
class LoginController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function index() {
        // Check if already logged in
        if (isset($_SESSION['user_id'])) {
            header('Location: /clothing-store/public/profile');
            exit;
        }

        // Render login page
        $this->renderView('auth/login');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Authenticate the user
            $user = $this->userModel->authenticate($username, $password);

            if ($user) {
                // Set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Check if there was a referrer before login
                if (isset($_SESSION['redirect_url'])) {
                    $redirect_url = $_SESSION['redirect_url'];
                    unset($_SESSION['redirect_url']);  // Clear the redirect URL
                    header("Location: $redirect_url");
                    exit;
                } else {
                    // Default redirection after login: profile page
                    header('Location: /clothing-store/public/profile');
                    exit;
                }
            } else {
                // Authentication failed
                $this->renderView('auth/login', ['error' => 'Invalid login credentials']);
            }
        } else {
            // Show the login form
            $this->renderView('auth/login');
        }
    }

    public function logout() {
        // Clear the session and log the user out
        session_unset();
        session_destroy();
        header('Location: /clothing-store/public/');
    }
}
