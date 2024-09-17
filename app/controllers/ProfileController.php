<?php
class ProfileController extends Controller {
    private $userModel;
    private $orderModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /clothing-store/public/login');
            exit;
        }
    
        $userId = $_SESSION['user_id'];
        echo "User ID: " . $userId;  // Debugging
    
        $customer = $this->userModel->getUserById($userId);
        echo "<pre>"; print_r($customer); echo "</pre>";  // Debugging
    
        $orders = $this->orderModel->getOrdersByUser($userId);
        echo "<pre>"; print_r($orders); echo "</pre>";  // Debugging
    
        if (!$customer) {
            die('Customer not found.');
        }
    
        $this->renderView('customer/profile', ['customer' => $customer, 'orders' => $orders]);
    }
    
}

