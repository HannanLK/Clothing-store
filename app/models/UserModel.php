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

    public function addUser($data) {
        $this->db->query('INSERT INTO users (name, email, address, phone, username, password, role) 
                          VALUES (:name, :email, :address, :phone, :username, :password, :role)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        return $this->db->execute();
    }

    public function updateUser($userId, $data) {
        $this->db->query('UPDATE users SET name = :name, email = :email, address = :address, phone = :phone, username = :username, role = :role WHERE user_id = :id');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    public function deleteUser($userId) {
        $this->db->query('DELETE FROM users WHERE user_id = :id');
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }
}
