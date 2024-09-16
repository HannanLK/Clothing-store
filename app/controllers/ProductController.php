<?php

class ProductController extends Controller {

    private $productModel;

    public function __construct() {
        // Load the ProductModel
        $this->productModel = $this->model('ProductModel');
    }

    public function index() {
        // Redirect to the mens page by default
        $this->mens();
    }

    // Method for sorting and displaying men's products
    public function mens() {
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date_new';  // Default sort by newest

        // Fetch sorted products from the model
        $products = $this->productModel->getSortedProductsByCategory('mens', $sortOption);

        // If it's an AJAX request, return the data as JSON
        if ($this->isAjax()) {
            header('Content-Type: application/json');
            echo json_encode($products);
            exit;
        }

        // Render the view with sorted products
        $this->renderView('customer/mens', ['products' => $products, 'sortOption' => $sortOption]);
    }

    // Method for sorting and displaying women's products
    public function womens() {
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date_new';  // Default sort by newest

        // Fetch sorted products from the model
        $products = $this->productModel->getSortedProductsByCategory('womens', $sortOption);

        // If it's an AJAX request, return the data as JSON
        if ($this->isAjax()) {
            header('Content-Type: application/json');
            echo json_encode($products);
            exit;
        }

        // Render the view with sorted products
        $this->renderView('customer/womens', ['products' => $products, 'sortOption' => $sortOption]);
    }

    // Method for sorting and displaying accessories products
    public function accessories() {
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date_new';  // Default sort by newest

        // Fetch sorted products from the model
        $products = $this->productModel->getSortedProductsByCategory('accessories', $sortOption);

        // If it's an AJAX request, return the data as JSON
        if ($this->isAjax()) {
            header('Content-Type: application/json');
            echo json_encode($products);
            exit;
        }

        // Render the view with sorted products
        $this->renderView('customer/accessories', ['products' => $products, 'sortOption' => $sortOption]);
    }

    // Method for fetching product details for modal view
    public function details() {
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            $product = $this->productModel->getProductById($productId);

            // Return product details as JSON
            if ($product) {
                header('Content-Type: application/json');
                echo json_encode($product);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Product not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'No product ID provided']);
        }
        exit;
    }

    // Helper method to check if it's an AJAX request
    private function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}
