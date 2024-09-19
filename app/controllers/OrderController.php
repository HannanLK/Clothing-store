

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


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
            $cartItems = $this->cartModel->getCartItems($userId);  // Make sure this returns the correct items
            $totalAmount = $_POST['total'];
    
            // Insert the order into the database
            $orderId = $this->orderModel->createOrder($userId, $totalAmount, $_POST['address'], $_POST['phone']);
    
            // Insert each cart item into the order_items table
            foreach ($cartItems as $item) {
                // Check if orderId and cartItems are correct at this point
                $this->orderModel->addOrderItem($orderId, $item['id'], $item['quantity'], $item['price']);
            }
    
            // Clear the cart for the user
            $this->cartModel->clearCart($userId);
    
            // Redirect to thank you page
            header('Location: /clothing-store/public/checkout/thankYou');
            exit;
        }
    }
    
    // Fetch and return order details as JSON
    public function getOrderDetails() {
        // Validate the order ID from the request
        if (isset($_GET['id'])) {
            $orderId = htmlspecialchars($_GET['id']);

            // Fetch the order details
            $orderDetails = $this->orderModel->getOrderById($orderId);

            if ($orderDetails) {
                // Set response as JSON and output the details
                header('Content-Type: application/json');
                echo json_encode($orderDetails);
                exit();
            } else {
                // If order not found, return an error in JSON format
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Order not found']);
                exit();
            }
        } else {
            // Return an error if the ID is missing
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Order ID not provided']);
            exit();
        }
    }

    // Thank you method
    public function thankYou() {
        $this->renderView('customer/thankyou');
    }
}
