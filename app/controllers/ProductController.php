<?php

class ProductController extends Controller {

    private $productModel;

    public function __construct() {
        // Load the ProductModel
        $this->productModel = $this->model('ProductModel');
    }

    // Method for fetching and displaying men's products
    public function mens() {
        // Fetch men's products from the database
        $products = $this->productModel->getProductsByCategory('mens');
        
        // Render the men's products view and pass the products data
        $this->renderView('products/mens/index', ['products' => $products]);
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
