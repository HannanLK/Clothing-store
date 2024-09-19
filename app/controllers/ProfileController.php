<?php
class ProfileController extends Controller {
    private $userModel;
    private $orderModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
    }

    // This method will be used to load the profile page
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit();
        }
    
        // Fetch the user ID from the session
        $userId = $_SESSION['user_id'];
    
        // Fetch the correct user information from the database
        $customer = $this->userModel->getUserById($userId);
        $orders = $this->orderModel->getOrdersByUser($userId);  // Fetch the user's orders
    
        // Render the profile page with user data and orders
        $this->renderView('customer/profile', [
            'customer' => $customer,
            'orders' => $orders  // Pass 'orders' data to the view
        ]);
    }
    
    
    // This method handles profile updates
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get user ID from session
            $userId = $_SESSION['user_id'];
            
            // Sanitize input
            $data = [
                'name' => htmlspecialchars(trim($_POST['name'])),
                'address' => htmlspecialchars(trim($_POST['address'])),
                'phone' => htmlspecialchars(trim($_POST['phone'])),
            ];
    
            // Update user data in the database
            $this->userModel->updateUser($userId, $data);
            
            // Redirect back to the profile page after updating
            header('Location: /clothing-store/public/profile');
            exit;
        }
    }
}