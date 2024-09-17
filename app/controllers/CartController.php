<?php

class CartController extends Controller {

    private $cartModel;
    private $productModel;  // Add ProductModel here

    public function __construct() {
        $this->cartModel = $this->model('CartModel');
        $this->productModel = $this->model('ProductModel');  // Load the ProductModel
    }

    // Display the cart
    public function index() {
        // Check if user is logged in
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $cartItems = $this->cartModel->getCartItems($userId);
        } else {
            // Fetch cart items from the session for guest users
            $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        }
    
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $tax = $subtotal * 0.10; // Assuming 10% tax
        $total = $subtotal + $tax;
    
        $this->renderView('customer/cart', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ]);
    }
    
    // Add item to cart
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['product_id'];
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $this->cartModel->addProductToCart($userId, $productId, $quantity);
            } else {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
    
                // Fetch the product from the ProductModel
                $product = $this->productModel->getProductById($productId);  
    
                if ($product) {
                    // Add product details, including category_id, to session cart
                    if (isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity'] += $quantity;
                    } else {
                        $_SESSION['cart'][$productId] = [
                            'id' => $product['id'],
                            'name' => $product['name'],
                            'price' => $product['price'],
                            'quantity' => $quantity,
                            'image' => $product['image'],
                            'category_id' => $product['category_id'],  // Store the category_id as well
                        ];
                    }
                } else {
                    // Handle error when product is not found
                    echo 'Product not found!';
                    exit;
                }
            }
    
            header('Location: /clothing-store/public/cart');
            exit;
        }
    }
    
    
    // Remove item from cart
    public function removeItem() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['product_id'];

            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $this->cartModel->removeCartItem($userId, $productId);
            } else {
                // Guest cart stored in session
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $item) {
                        if ($item['id'] == $productId) {
                            unset($_SESSION['cart'][$key]);
                            break;
                        }
                    }
                }
            }

            // Redirect to cart
            header('Location: ' . BASE_URL . 'cart');
            exit;
        }
    }

    // Update quantity in cart// Update quantity in cart
    public function updateQuantity() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $productId = $data['product_id'];
            $quantity = $data['quantity'];
    
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $this->cartModel->updateProductQuantity($userId, $productId, $quantity);
            } else {
                // Guest cart stored in session
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['id'] == $productId) {
                            $item['quantity'] = $quantity;
                            break;
                        }
                    }
                }
            }
    
            // Send a success response in JSON format
            echo json_encode(['success' => true]);
            exit;
        }
        
        // Send an error response if it's not a POST request
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        exit;
    }

    public function proceedToCheckout() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // Store the intended URL (checkout) in session
            $_SESSION['redirect_url'] = BASE_URL . 'checkout';
            
            // Redirect to login page
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        
        // If logged in, proceed to checkout
        header('Location: ' . BASE_URL . 'checkout');
        exit;
    }

    

}
