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

        // Execute the query
        if ($this->db->execute()) {
            return $this->db->lastInsertId();  // Return the order ID
        } else {
            return false;  // Return false if the order could not be created
        }
    }
}
