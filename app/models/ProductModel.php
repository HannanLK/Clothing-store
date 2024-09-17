<?php

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Method to fetch all products
    public function getAllProducts() {
        $this->db->query('SELECT * FROM products');
        return $this->db->resultSet();
    }

    // Method to fetch sorted products by category
    public function getSortedProductsByCategory($category, $sortOption, $stockFilter = null) {
        // Default query to fetch products by category
        $query = 'SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = :category)';
        
        // Filter by stock status if provided
        if ($stockFilter === 'in') {
            $query .= ' AND quantity > 0';
        } elseif ($stockFilter === 'out') {
            $query .= ' AND quantity = 0';
        }
    
        // Modify query based on sort option
        switch ($sortOption) {
            case 'name_asc':
                $query .= ' ORDER BY name ASC';
                break;
            case 'name_desc':
                $query .= ' ORDER BY name DESC';
                break;
            case 'price_asc':
                $query .= ' ORDER BY price ASC';
                break;
            case 'price_desc':
                $query .= ' ORDER BY price DESC';
                break;
            case 'date_new':
                $query .= ' ORDER BY created_at DESC';
                break;
            case 'date_old':
                $query .= ' ORDER BY created_at ASC';
                break;
        }
    
        $this->db->query($query);
        $this->db->bind(':category', $category);  // Bind the category
        return $this->db->resultSet();
    }
    
        
    // Method to add a new product
    public function addProduct($name, $category, $price, $quantity, $description, $image) {
        $this->db->query('INSERT INTO products (name, category_id, price, quantity, description, image, created_at) VALUES (:name, (SELECT id FROM categories WHERE name = :category), :price, :quantity, :description, :image, NOW())');
        $this->db->bind(':name', $name);
        $this->db->bind(':category', $category);
        $this->db->bind(':price', $price);
        $this->db->bind(':quantity', $quantity);  // Bind quantity
        $this->db->bind(':description', $description);
        $this->db->bind(':image', $image);
        $this->db->execute();
    }

    // Method to update an existing product
    public function updateProduct($id, $name, $category, $price, $quantity, $description, $image = null) {
        if ($image) {
            $this->db->query('UPDATE products SET name = :name, price = :price, quantity = :quantity, description = :description, image = :image, category_id = (SELECT id FROM categories WHERE name = :category) WHERE id = :id');
            $this->db->bind(':image', $image);
        } else {
            $this->db->query('UPDATE products SET name = :name, price = :price, quantity = :quantity, description = :description, category_id = (SELECT id FROM categories WHERE name = :category) WHERE id = :id');
        }
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        $this->db->bind(':price', $price);
        $this->db->bind(':quantity', $quantity);  // Bind quantity
        $this->db->bind(':description', $description);
        $this->db->bind(':category', $category);
        $this->db->execute();
    }

    // Method to delete a product
    public function deleteProduct($id) {
        $this->db->query('DELETE FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function getNewArrivals() {
        $this->db->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 4");
        return $this->db->resultSet();
    }

    public function getFeaturedProducts() {
        $this->db->query("SELECT * FROM products WHERE is_featured = 1 LIMIT 8");
        return $this->db->resultSet();
    }

    // Method to fetch products by category
    public function getProductsByCategory($category) {
        // Create the query to fetch products based on category
        $this->db->query('SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = :category)');
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }

    // ProductModel.php
    public function getProductById($id) {
        $this->db->query('SELECT * FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateProductQuantity($productId, $newQuantity) {
        $this->db->query("UPDATE products SET quantity = :quantity WHERE id = :id");
        $this->db->bind(':quantity', $newQuantity);
        $this->db->bind(':id', $productId);
        $this->db->execute();
    }

    public function getProductCount() {
        $this->db->query("SELECT COUNT(*) AS count FROM products");
        return $this->db->single()['count'];  // Return the count from the array
    }
    
}
