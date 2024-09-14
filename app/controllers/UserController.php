<?php

class UserController extends Controller {

    public function users() {
        $users = $this->model('UserModel')->getAllUsers();
        $this->renderView('admin/users', ['users' => $users]);
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => htmlspecialchars(trim($_POST['name'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'address' => htmlspecialchars(trim($_POST['address'])),
                'phone' => htmlspecialchars(trim($_POST['phone'])),
                'username' => htmlspecialchars(trim($_POST['username'])),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role' => htmlspecialchars(trim($_POST['role'])),
            ];
    
            $this->model('UserModel')->addUser($data);
            header('Location: /clothing-store/public/admin/users');
            exit();
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
