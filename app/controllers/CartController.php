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

        // Calculate the subtotal, tax, and total
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $tax = $subtotal * 0.10; // 10% tax
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
            $userId = $_SESSION['user_id']; // Get the user_id from session
            $productId = $_POST['product_id']; // Get product_id from form
    
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

    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ensure the user is logged in
            if (!isset($_SESSION['user_id'])) {
                header('Location: /clothing-store/public/login');
                exit;
            }
    
            // Get the user ID from the session
            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'];
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
            // Add the product to the cart
            $this->cartModel->addProductToCart($userId, $productId, $quantity);
    
            // Redirect to the cart page
            header('Location: /clothing-store/public/cart');
            exit;
        }
    }

    public function updateQuantity() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ensure the user is logged in
            if (!isset($_SESSION['user_id'])) {
                echo json_encode(['success' => false, 'message' => 'User not logged in']);
                exit;
            }
    
            // Get data from the request
            $data = json_decode(file_get_contents('php://input'), true);
            $productId = $data['product_id'];
            $quantity = $data['quantity'];
            $userId = $_SESSION['user_id'];
    
            // Update the product quantity in the cart using the model
            $this->cartModel->updateProductQuantity($userId, $productId, $quantity);
    
            // Send a success response
            echo json_encode(['success' => true]);
        }
    }
    
    
}
