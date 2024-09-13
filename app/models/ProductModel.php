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
    public function getSortedProductsByCategory($category, $sortOption) {
        // Default query
        $query = 'SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = :category)';

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

        // Prepare and execute query
        $this->db->query($query);
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }

    // Method to add a new product
    public function addProduct($name, $category, $price, $description, $image) {
        $this->db->query('INSERT INTO products (name, category_id, price, description, image, created_at) VALUES (:name, (SELECT id FROM categories WHERE name = :category), :price, :description, :image, NOW())');
        $this->db->bind(':name', $name);
        $this->db->bind(':category', $category);
        $this->db->bind(':price', $price);
        $this->db->bind(':description', $description);
        $this->db->bind(':image', $image);
        $this->db->execute();
    }

    // Method to update an existing product
    public function updateProduct($id, $name, $category, $price, $description, $image = null) {
        if ($image) {
            $this->db->query('UPDATE products SET name = :name, price = :price, description = :description, image = :image, category_id = (SELECT id FROM categories WHERE name = :category) WHERE id = :id');
            $this->db->bind(':image', $image);
        } else {
            $this->db->query('UPDATE products SET name = :name, price = :price, description = :description, category_id = (SELECT id FROM categories WHERE name = :category) WHERE id = :id');
        }
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        $this->db->bind(':price', $price);
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
}
