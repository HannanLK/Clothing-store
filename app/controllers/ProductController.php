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

    public function mens() {
        // Check for sorting option from the GET parameters
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date_new';  // Default sort option
    
        // Fetch men's products based on the selected sort option
        $products = $this->productModel->getSortedProductsByCategory('mens', $sortOption);
        
        // Render the men's products view and pass the products data and sort option
        $this->renderView('customer/mens', ['products' => $products, 'sortOption' => $sortOption]);
    }
    
    

    // Method for fetching and displaying women's products
    public function womens() {
        // Fetch women's products from the database
        $products = $this->productModel->getProductsByCategory('womens');
        
        // Render the women's products view and pass the products data
        $this->renderView('products/womens/index', ['products' => $products]);
    }

    // Method for fetching and displaying accessories
    public function accessories() {
        // Fetch accessories from the database
        $products = $this->productModel->getProductsByCategory('accessories');
        
        // Render the accessories products view and pass the products data
        $this->renderView('products/accessories/index', ['products' => $products]);
    }
    
}
