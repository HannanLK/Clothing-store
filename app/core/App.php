<?php
class App {
    protected $controller = 'HomeController';  // Default controller
    protected $method = 'index';               // Default method
    protected $params = [];                    // Parameters passed in the URL

    public function __construct() {
        // Check if a session is not already started before calling session_start()
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $url = $this->parseUrl();  // Get the URL as an array

        // Debugging: Print the parsed URL (for testing)
        echo 'Parsed URL: <pre>' . print_r($url, true) . '</pre>';

        // Check if the URL starts with 'admin'
        if (isset($url[0]) && strtolower($url[0]) == 'admin') {
            // Check if the user is an admin
            if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                // Redirect to login if not an admin
                header('Location: /clothing-store/public/login');
                exit;
            }
            
            // Handle user management routes
            if (isset($url[1]) && in_array(strtolower($url[1]), ['users', 'adduser', 'edituser', 'deleteuser'])) {
                $this->controller = 'UserController';  // Set UserController for user management
            }
            // Handle inquiry management routes
            else if (isset($url[1]) && in_array(strtolower($url[1]), ['inquiries', 'addinquiry', 'editinquiry', 'deleteinquiry', 'updatestatus'])) {
                $this->controller = 'InquiryController'; // Set InquiryController for inquiries
            }
            // Other admin-related routes
            else {
                $this->controller = 'AdminController'; // Default to AdminController for other admin routes
            }
        }
        // Handle customer routes like mens, womens, accessories
        else if (isset($url[0]) && in_array(strtolower($url[0]), ['mens', 'womens', 'accessories'])) {
            $this->controller = 'ProductController';
        }
        // Handle cart routes
        else if (isset($url[0]) && strtolower($url[0]) == 'cart') {
            if (!isset($_SESSION['user_id'])) {
                // Redirect to login if the user is not logged in
                header('Location: /clothing-store/public/login');
                exit;
            }
            $this->controller = 'CartController';
        }
        // Handle login and logout
        else if (isset($url[0]) && strtolower($url[0]) == 'login') {
            $this->controller = 'LoginController';
        }
        else if (isset($url[0]) && strtolower($url[0]) == 'logout') {
            $this->controller = 'LoginController';
            $this->method = 'logout';
        }
        // Manually map 'products' to 'ProductController'
        else if (isset($url[0]) && strtolower($url[0]) == 'products') {
            $this->controller = 'ProductController';
        }
        // Load other controllers dynamically if they exist
        else if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';  // Set the controller based on the first URL segment
        }

        // Debugging: Print the controller being loaded
        echo 'Loading controller: ' . $this->controller . '<br>';

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
            $this->method = $url[1];  // Set the method
            unset($url[1]);  // Remove the method from the URL array
        }

        // Any remaining parts of the URL are considered parameters
        $this->params = $url ? array_values($url) : [];

        // Call the controller method with the parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Function to parse the URL and return it as an array
    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
