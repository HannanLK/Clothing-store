<?php
class ProfileController extends Controller {
    private $userModel;
    private $orderModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
    }

    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /clothing-store/public/login');
            exit;
        }
    
        // Fetch the user ID from the session
        $userId = $_SESSION['user_id'];
    
        // Fetch customer information from the database
        $customer = $this->userModel->getUserById($userId);
    
        // Fetch the user's order history
        $orders = $this->orderModel->getOrdersByUser($userId);
    
        // Check if the customer exists
        if (!$customer) {
            die('Customer not found.');
        }
    
        // Render the profile view with customer and order data
        $this->renderView('customer/profile', ['customer' => $customer, 'orders' => $orders]);
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            
            $data = [
                'name' => htmlspecialchars(trim($_POST['name'])),
                'address' => htmlspecialchars(trim($_POST['address'])),
                'phone' => htmlspecialchars(trim($_POST['phone'])),
            ];
    
            $this->userModel->updateUser($userId, $data);
            
            // Refresh the page after saving
            header('Location: /clothing-store/public/profile');
            exit;
        }
    }
    
}
