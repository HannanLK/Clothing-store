<?php
class ProfileController extends Controller {
    private $userModel;
    private $orderModel;  // Ensure orderModel is defined

    public function __construct() {
        // Load the models
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');  // Initialize orderModel
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
        
        // Fetch the user's orders
        $orders = $this->orderModel->getOrdersByUser($userId);

        // Debugging step to check if user and order data is being fetched
        // echo "<pre>";
        // print_r($customer);
        // print_r($orders);
        // echo "</pre>";

        // Render the profile page with user data and orders
        $this->renderView('customer/profile', [
            'customer' => $customer,
            'orders' => $orders
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
            header('Location: ' . BASE_URL . 'profile');
            exit;
        }
    }
}
