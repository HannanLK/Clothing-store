<?php
class UserController extends Controller {
    private $userModel;

    public function __construct() {
        // Load the UserModel
        $this->userModel = $this->model('UserModel');
    }

    public function users() {
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : null;
        $users = $this->model('UserModel')->getAllUsers($sortOption);
        $this->renderView('admin/users', ['users' => $users]);
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate inputs properly
            $data = [
                'name' => htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8'),
                'email' => filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL),
                'address' => htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8'),
                'phone' => filter_var(trim($_POST['phone']), FILTER_SANITIZE_NUMBER_INT),
                'username' => htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8'),
                'password' => $_POST['password'],  // Passwords should not be sanitized, only hashed
                'role' => htmlspecialchars(trim($_POST['role']), ENT_QUOTES, 'UTF-8')
            ];
    
            // Check if email validation failed
            if (!$data['email']) {
                $this->renderView('admin/addUser', ['error' => 'Invalid email address.']);
                return;
            }
    
            // Try to add the user
            $result = $this->userModel->addUser($data);
    
            // Check if there's an error (e.g., duplicate email)
            if (isset($result['error'])) {
                // Render the addUser view and pass the error to it
                $this->renderView('admin/addUser', ['error' => $result['error']]);
            } else {
                // Redirect to the users page upon successful addition
                header('Location: /clothing-store/public/admin/users');
                exit();
            }
        } else {
            // If the request method is not POST, render the addUser form
            $this->renderView('admin/addUser');
        }
    }
    
    public function editUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = htmlspecialchars(trim($_POST['user_id']));
            $data = [
                'name' => htmlspecialchars(trim($_POST['name'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'address' => htmlspecialchars(trim($_POST['address'])),
                'phone' => htmlspecialchars(trim($_POST['phone'])),
                'username' => htmlspecialchars(trim($_POST['username'])),
                'role' => htmlspecialchars(trim($_POST['role'])),
            ];

            $this->model('UserModel')->updateUser($userId, $data);
            header('Location: /clothing-store/public/admin/users');
            exit();
        }
    }

    public function deleteUser() {
        if (isset($_GET['id'])) {
            $userId = htmlspecialchars($_GET['id']);
            $this->model('UserModel')->deleteUser($userId);
            header('Location: /clothing-store/public/admin/users');
        }
    }
}
