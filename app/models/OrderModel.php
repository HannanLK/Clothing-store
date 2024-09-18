<?php
class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Create a new order in the database
    public function createOrder($userId, $totalAmount, $address, $contactNumber) {
        $this->db->query("INSERT INTO orders (user_id, total, address, contact_number) 
                          VALUES (:user_id, :total, :address, :contact_number)");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':total', $totalAmount);
        $this->db->bind(':address', $address);
        $this->db->bind(':contact_number', $contactNumber);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();  // Return the order ID
        } else {
            return false;  // Return false if the order could not be created
        }
    }

    // Fetch orders by user ID
    public function getOrdersByUser($userId) {
        $this->db->query('SELECT * FROM orders WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    public function getSalesRevenue() {
        $this->db->query("SELECT SUM(total) AS revenue FROM orders");
        return $this->db->single()['revenue'];  // Access revenue as an array
    }
    
    
    public function getAllSales() {
        // Assuming the users table stores customer details
        $this->db->query("
            SELECT 
                orders.id AS order_id, 
                users.name AS customer_name, 
                orders.total, 
                orders.created_at AS date 
            FROM orders 
            JOIN users ON orders.user_id = users.user_id
        ");
        return $this->db->resultSet();
    }
    
    
}
