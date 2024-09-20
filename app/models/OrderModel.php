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


    // Fetch orders for a specific user
    public function getOrdersByUser($userId) {
        // Fetch the orders for the user
        $this->db->query("SELECT * FROM orders WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        $orders = $this->db->resultSet();  // Fetch all orders
    
        // Loop through each order and fetch the products
        foreach ($orders as &$order) {
            $this->db->query("
                SELECT products.id, products.name, products.image, products.category_id, order_items.quantity
                FROM order_items
                JOIN products ON order_items.product_id = products.id
                WHERE order_items.order_id = :order_id
            ");
            $this->db->bind(':order_id', $order['id']);
            $order['products'] = $this->db->resultSet();  // Add products to each order
        }
    
        return $orders;
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

    // Get order by ID with details
    public function getOrderById($orderId) {
        $this->db->query("
            SELECT 
                orders.id AS order_id, 
                users.name AS customer_name, 
                orders.total, 
                GROUP_CONCAT(products.name SEPARATOR ', ') AS products, 
                orders.created_at AS date 
            FROM orders 
            JOIN users ON orders.user_id = users.user_id
            JOIN order_items ON orders.id = order_items.order_id  -- Correct join to order_items
            JOIN products ON order_items.product_id = products.id
            WHERE orders.id = :order_id
            GROUP BY orders.id
        ");
        $this->db->bind(':order_id', $orderId);
        return $this->db->single();  // Fetch the order details
    }
    
    public function addOrderItem($orderId, $productId, $quantity, $price) {
        $this->db->query("INSERT INTO order_items (order_id, product_id, quantity, price) 
                          VALUES (:order_id, :product_id, :quantity, :price)");
        $this->db->bind(':order_id', $orderId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':price', $price);
        return $this->db->execute();

    }
    
    
    
}
