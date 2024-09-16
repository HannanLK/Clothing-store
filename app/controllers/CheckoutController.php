<?php

class CheckoutController extends Controller {
    
    private $userModel;
    private $cartModel;

    public function __construct() {
        // Load necessary models
        $this->userModel = $this->model('UserModel');
        $this->cartModel = $this->model('CartModel');
    }

    // Display the checkout page
    public function index() {
        // Ensure the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /clothing-store/public/login');
            exit;
        }

        // Get the user ID from the session
        $userId = $_SESSION['user_id'];

        // Fetch customer information
        $customer = $this->userModel->getUserById($userId);

        // Fetch cart items for the logged-in user
        $cartItems = $this->cartModel->getCartItems($userId);

        // Calculate the subtotal, tax, and total
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        // Pass the data to the view
        $this->renderView('customer/checkout', [
            'customer' => $customer,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ]);
    }

    // Method to handle placing an order (this will be added later)
    public function placeOrder() {
        // Logic to place order, deduct stock, and add order to the database
    }
}
