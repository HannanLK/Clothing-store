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

    // ProductController.php
    public function mens() {
        // Check for sort options from the query string
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date_new';  // Default sort by newest
    
        // Fetch sorted products from the existing method
        $products = $this->productModel->getSortedProductsByCategory('mens', $sortOption);
    
        // If it's an AJAX request, return the data as JSON
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            echo json_encode($products);
            exit; // Stop further execution for AJAX
        }
    
        // Render the view with sorted products
        $this->renderView('customer/mens', ['products' => $products, 'sortOption' => $sortOption]);
    }
    
    // Other product categories such as womens, accessories, etc.
    public function womens() {
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date_new';  // Default sort by newest
        $products = $this->productModel->getSortedProductsByCategory('womens', $sortOption);
        $this->renderView('customer/womens', ['products' => $products, 'sortOption' => $sortOption]);
    }

    public function accessories() {
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date_new';  // Default sort by newest
        $products = $this->productModel->getSortedProductsByCategory('accessories', $sortOption);
        $this->renderView('customer/accessories', ['products' => $products, 'sortOption' => $sortOption]);
    }

    // ProductController.php
    public function details() {
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            $product = $this->productModel->getProductById($productId);

            // Return product details as JSON
            if ($product) {
                echo json_encode($product);
            } else {
                echo json_encode(['error' => 'Product not found']);
            }
        } else {
            echo json_encode(['error' => 'No product ID provided']);
        }
    }

}
