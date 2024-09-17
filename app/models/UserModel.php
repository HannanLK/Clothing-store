<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Method to fetch all users with optional sorting
    public function getAllUsers($sort = null) {
        $query = 'SELECT * FROM users';

        // Modify query based on sort option
        if ($sort == 'customer') {
            $query .= ' WHERE role = "customer"';
        } elseif ($sort == 'admin') {
            $query .= ' WHERE role = "admin"';
        } elseif ($sort == 'time_asc') {
            $query .= ' ORDER BY created_at ASC';
        } elseif ($sort == 'time_desc') {
            $query .= ' ORDER BY created_at DESC';
        }

        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Method to authenticate user
    public function login($username, $password) {
        // Fetch the user by username
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        $user = $this->db->single();

        // Check if user exists and the password matches
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return the user if credentials are valid
        } else {
            return false; // Return false if invalid
        }
    }

    // Method to add a new user
    public function addUser($data) {
        // Check if the email already exists
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $data['email']);
        $existingUser = $this->db->single();
    
        // If an existing user with the same email is found, return an error
        if ($existingUser) {
            return ['error' => 'Email already exists. Please use a different email.'];
        }
    
        // Proceed with the insertion if no duplicate email is found
        $this->db->query('INSERT INTO users (name, email, address, phone, username, password, role) 
                          VALUES (:name, :email, :address, :phone, :username, :password, :role)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT)); // Hash the password
        $this->db->bind(':role', $data['role']);
        
        if ($this->db->execute()) {
            return true;  // Return true if the insert was successful
        } else {
            return ['error' => 'There was an error adding the user.'];  // Return a general error message if insert fails
        }
    }
    
    
    // Method to update an existing user
    public function updateUser($userId, $data) {
        $this->db->query('UPDATE users SET name = :name, address = :address, phone = :phone WHERE user_id = :user_id');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
    
    // Method to delete a user
    public function deleteUser($userId) {
        $this->db->query('DELETE FROM users WHERE user_id = :id');
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    // Authenticate a user by username and password
    public function authenticate($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        $user = $this->db->single();

        // If user is found and password matches
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    // Get user by ID
    public function getUserById($userId) {
        $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }

    public function getUserCount() {
        $this->db->query("SELECT COUNT(*) AS count FROM users");
        return $this->db->single()['count'];  // Access count as an array
    }
    
    public function getAdminCount() {
        $this->db->query("SELECT COUNT(*) AS count FROM users WHERE role = 'admin'");
        return $this->db->single()['count'];  // Access count as an array
    }
    
    public function getCustomerCount() {
        $this->db->query("SELECT COUNT(*) AS count FROM users WHERE role = 'customer'");
        return $this->db->single()['count'];  // Access count as an array
    }
    
    
}
