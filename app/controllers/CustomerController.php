<?php

class CustomerController extends Controller {

    private $productModel;
    private $cartModel;

    public function __construct() {
        $this->productModel = $this->model('ProductModel');
        $this->cartModel = $this->model('CartModel');
    }

    // Fetch product details via AJAX
    public function getProductDetails() {
        if (isset($_GET['id'])) {
            $product = $this->productModel->getProductById($_GET['id']);
            echo json_encode($product);
        }
    }

    // Add product to the cart
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['product_id'];
            $userId = $_SESSION['user_id']; // Assuming the user is logged in
            $this->cartModel->addProductToCart($userId, $productId);
            echo json_encode(['status' => 'success']);
        }
    }
}
