<?php

class CartController extends Controller {

    private $cartModel;

    public function __construct() {
        // Load the CartModel
        $this->cartModel = $this->model('CartModel');
    }

    // Display the cart
    public function index() {
        // Ensure the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /clothing-store/public/login');
            exit;
        }

        // Get the user ID from the session
        $userId = $_SESSION['user_id'];

        // Retrieve the cart items for the logged-in user
        $cartItems = $this->cartModel->getCartItems($userId);

        // Calculate subtotal, tax, and total
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = $subtotal * 0.10;  // 10% tax
        $total = $subtotal + $tax;

        // Render the cart view
        $this->renderView('customer/cart', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ]);
    }

    // Remove an item from the cart
    public function removeItem() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'];
    
            // Remove the item from the cart using the model
            $this->cartModel->removeCartItem($userId, $productId);
    
            // Redirect back to the cart page
            header('Location: /clothing-store/public/cart');
            exit;
        }
    }
    
    public function checkLoginStatus() {
        header('Content-Type: application/json');
        
        if (isset($_SESSION['user_id'])) {
            echo json_encode(['isLoggedIn' => true]);
        } else {
            echo json_encode(['isLoggedIn' => false]);
        }
        
        exit;
    }
    
}
