<?php

class CartController extends Controller {

    private $cartModel;

    public function __construct() {
        // Load the CartModel
        $this->cartModel = $this->model('CartModel');
    }

    // Add product to cart
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
        }
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

        // Render the cart view
        $this->renderView('customer/cart', [
            'cartItems' => $cartItems,
        ]);
    }

    // Remove an item from the cart
    public function removeItem() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'];

            $this->cartModel->removeCartItem($userId, $productId);

            // Redirect to the cart page
            header('Location: /clothing-store/public/cart');
        }
    }
}
