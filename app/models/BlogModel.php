<?php

class BlogModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Method to add a new blog
    public function addBlog($data) {
        $this->db->query('INSERT INTO blogs (title, image, content, author, summary, date_added) 
                          VALUES (:title, :image, :content, :author, :summary, NOW())');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':summary', $data['summary']);
        
        return $this->db->execute();
    }

    // Method to update an existing blog
    public function updateBlog($blogId, $data) {
        $this->db->query('UPDATE blogs SET title = :title, image = :image, content = :content, 
                          author = :author, summary = :summary WHERE id = :id');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':summary', $data['summary']);
        $this->db->bind(':id', $blogId);

        return $this->db->execute();
    }

    // Method to delete a blog
    public function deleteBlog($blogId) {
        $this->db->query('DELETE FROM blogs WHERE id = :id');
        $this->db->bind(':id', $blogId);
        return $this->db->execute();
    }

    // Method to fetch all blogs
    public function getAllBlogs() {
        $this->db->query('SELECT * FROM blogs ORDER BY date_added DESC');
        return $this->db->resultSet();
    }

    // Method to fetch recent blogs for the blog list page
    public function getRecentBlogs() {
        $this->db->query("SELECT * FROM blogs ORDER BY date_added DESC LIMIT 4");
        return $this->db->resultSet();
    }

    // Method to fetch a single blog by its ID (for the detailed view)
    public function getBlogById($id) {
        $this->db->query('SELECT * FROM blogs WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single(); // Return single result
    }

    // Method to fetch related blogs (excluding the current one)
    public function getRelatedBlogs($currentBlogId) {
        $this->db->query('SELECT * FROM blogs WHERE id != :id LIMIT 4');
        $this->db->bind(':id', $currentBlogId);
        return $this->db->resultSet();
    }
}
