<?php

class OrderController extends Controller {

    private $orderModel;
    private $cartModel;
    private $productModel;
    private $userModel;

    public function __construct() {
        $this->orderModel = $this->model('OrderModel');
        $this->cartModel = $this->model('CartModel');
        $this->productModel = $this->model('ProductModel');
        $this->userModel = $this->model('UserModel');
    }

    // Index method for loading the checkout page
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /clothing-store/public/login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $customer = $this->userModel->getUserById($userId);
        $cartItems = $this->cartModel->getCartItems($userId);

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        $this->renderView('customer/checkout', [
            'customer' => $customer,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ]);
    }

    // Handle order placement
    public function placeOrder() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user_id'];
            $cartItems = $this->cartModel->getCartItems($userId);
            $totalAmount = $_POST['total'];
    
            // Insert the order into the database
            $orderId = $this->orderModel->createOrder($userId, $totalAmount, $_POST['address'], $_POST['phone']);
    
            // Update product quantities and clear the cart
            foreach ($cartItems as $item) {
                // Fetch current product quantity
                $product = $this->productModel->getProductById($item['id']);
                $newQuantity = $product['quantity'] - $item['quantity'];
    
                // Ensure the quantity doesn't go below 0
                if ($newQuantity >= 0) {
                    $this->productModel->updateProductQuantity($item['id'], $newQuantity);
                } else {
                    $this->productModel->updateProductQuantity($item['id'], 0);
                }
            }
    
            // Clear the cart for the user
            $this->cartModel->clearCart($userId);
    
            // Redirect to thank you page
            header('Location: /clothing-store/public/checkout/thankYou');
            exit;
        }
    }
    
    // Thank you method
    public function thankYou() {
        $this->renderView('customer/thankyou');
    }
}
