<?php
class RegisterController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $data = [
                'name' => htmlspecialchars(trim($_POST['name'])),
                'email' => filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL),
                'username' => htmlspecialchars(trim($_POST['username'])),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)  // Hash password
            ];

            // Check if email validation failed
            if (!$data['email']) {
                $this->renderView('auth/register', ['error' => 'Invalid email address.']);
                return;
            }

            // Try to add the user
            $result = $this->userModel->addUser($data);

            if (isset($result['error'])) {
                // Render the register view with error
                $this->renderView('auth/register', ['error' => $result['error']]);
            } else {
                // Redirect to login after successful registration
                header('Location: /clothing-store/public/login');
                exit();
            }
        } else {
            // Render the register form
            $this->renderView('auth/register');
        }
    }
}
