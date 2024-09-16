<?php
class BlogController extends Controller {

    private $blogModel;

    public function __construct() {
        // Load the BlogModel
        $this->blogModel = $this->model('BlogModel');
    }

    // Method to list all blogs
    public function list() {
        // Fetch all blogs using the BlogModel
        $blogs = $this->blogModel->getAllBlogs();
        
        // Render the blogs view and pass the list of blogs to the view
        $this->renderView('customer/blogs', ['blogs' => $blogs]);
    }
}
