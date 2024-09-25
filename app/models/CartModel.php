<?php
class CartModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Add a product to the cart
    // public function addProductToCart($userId, $productId, $quantity) {
    //     if (!$productId) {
    //         // If product ID is null or missing, don't proceed
    //         return false;
    //     }
    
    //     $this->db->query("INSERT INTO cart (user_id, product_id, quantity) 
    //                       VALUES (:user_id, :product_id, :quantity)
    //                       ON DUPLICATE KEY UPDATE quantity = quantity + :quantity");
    //     $this->db->bind(':user_id', $userId);
    //     $this->db->bind(':product_id', $productId);
    //     $this->db->bind(':quantity', $quantity);
        
    //     return $this->db->execute();
    // }

    public function addProductToCart($userId, $productId, $quantity) {
        if (!$productId) {
            return false;
        }
    
        $this->db->query("INSERT INTO cart (user_id, product_id, quantity) 
                          VALUES (:user_id, :product_id, :quantity)
                          ON DUPLICATE KEY UPDATE quantity = quantity + :quantity");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':quantity', $quantity);
        
        return $this->db->execute();
    }
    
    
    
    // Get cart items for a specific user, including category_id for dynamic image paths
    public function getCartItems($userId) {
        $this->db->query("SELECT products.id, products.name, products.price, products.image, products.category_id, cart.quantity 
                          FROM cart 
                          JOIN products ON cart.product_id = products.id
                          WHERE cart.user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    // Remove an item from the cart
    public function removeCartItem($userId, $productId) {
        $this->db->query("DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id");
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);
        $this->db->execute();
    }

    public function updateProductQuantity($userId, $productId, $quantity) {
        $this->db->query("UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id");
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);
        $this->db->execute();
    }

    public function clearCart($userId) {
        $this->db->query('DELETE FROM cart WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        $this->db->execute();
    }
    
    // Add this method to delete cart items by product ID
    public function deleteItemsByProductId($productId) {
        $this->db->query('DELETE FROM cart WHERE product_id = :product_id');
        $this->db->bind(':product_id', $productId);
        $this->db->execute();
    }
    
    
    
}
