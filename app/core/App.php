<?php
class App {
    protected $controller = 'HomeController';  // Default controller
    protected $method = 'index';               // Default method
    protected $params = [];                    // Parameters passed in the URL

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $url = $this->parseUrl();  // Get the URL as an array

        // Check if the URL starts with 'admin'
        if (isset($url[0]) && strtolower($url[0]) == 'admin') {
            if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                header('Location: /clothing-store/public/login');
                exit;
            }

            if (isset($url[1]) && in_array(strtolower($url[1]), ['users', 'adduser', 'edituser', 'deleteuser'])) {
                $this->controller = 'UserController';
            } else if (isset($url[1]) && in_array(strtolower($url[1]), ['inquiries', 'addinquiry', 'editinquiry', 'deleteinquiry', 'updatestatus'])) {
                $this->controller = 'InquiryController';
            } else {
                $this->controller = 'AdminController';
            }
        } 
        // Check if the URL is related to mens, womens, or accessories
        else if (isset($url[0]) && in_array(strtolower($url[0]), ['mens', 'womens', 'accessories'])) {
            $this->controller = 'ProductController';
            $this->method = strtolower($url[0]);  // Set the method based on the URL (mens, womens, accessories)
        } 
        // Check if the URL is related to blogs
        else if (isset($url[0]) && strtolower($url[0]) == 'blogs') {
            $this->controller = 'BlogController';
            if (isset($url[1]) && strtolower($url[1]) == 'view' && isset($url[2])) {
                $this->method = 'view';
                $this->params = [$url[2]];  // Blog ID
            } else {
                $this->method = 'list';  // Default to the blog list method
            }
        }
        // Check if the URL is related to the cart
        else if (isset($url[0]) && strtolower($url[0]) == 'cart') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /clothing-store/public/login');
                exit;
            }
            $this->controller = 'CartController';
        } 
        // Check if the URL is related to login or logout
        else if (isset($url[0]) && strtolower($url[0]) == 'login') {
            $this->controller = 'LoginController';
        } 
        else if (isset($url[0]) && strtolower($url[0]) == 'logout') {
            $this->controller = 'LoginController';
            $this->method = 'logout';
        } 
        // Check for general product routes
        else if (isset($url[0]) && strtolower($url[0]) == 'products') {
            $this->controller = 'ProductController';
        } 
        // Check for dynamically loaded controllers
        else if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
        }

        // Include the controller file
        if (file_exists('../app/controllers/' . $this->controller . '.php')) {
            require_once '../app/controllers/' . $this->controller . '.php';
        } else {
            die("Controller file not found: " . $this->controller . '.php');
        }

        // Instantiate the controller class
        $this->controller = new $this->controller;

        // Check if a method is specified in the URL
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Any remaining parts of the URL are considered parameters
        $this->params = $url ? array_values($url) : [];

        // Call the controller method with the parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
