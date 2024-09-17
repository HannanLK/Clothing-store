<?php
class App {
    protected $controller = 'HomeController';  
    protected $method = 'index';               
    protected $params = [];                    
    protected $layout = 'layout/customer';     

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $url = $this->parseUrl();  

        // Handle admin section routing
        if (isset($url[0]) && strtolower($url[0]) == 'admin') {
            $this->layout = 'layout/admin';  
            if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                $_SESSION['redirect_url'] = BASE_URL . implode('/', $url);
                header('Location: ' . BASE_URL . 'login');
                exit;
            }
            $this->controller = 'AdminController';
        }

        // Handle cart routing
        else if (isset($url[0]) && strtolower($url[0]) == 'cart') {
            $this->controller = 'CartController';
            if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
            } else {
                $this->method = 'index';
            }
        } 

        // Handle login routing
        else if (isset($url[0]) && strtolower($url[0]) == 'login') {
            $this->controller = 'LoginController';
            $this->method = 'index';
        } 

        // Handle logout routing
        else if (isset($url[0]) && strtolower($url[0]) == 'logout') {
            $this->controller = 'LoginController';
            $this->method = 'logout';
        } 

        // Handle profile routing
        else if (isset($url[0]) && strtolower($url[0]) == 'profile') {
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['redirect_url'] = BASE_URL . implode('/', $url);
                header('Location: ' . BASE_URL . 'login');
                exit;
            }
            $this->controller = 'ProfileController';
            if (isset($url[1]) && strtolower($url[1]) == 'edit') {
                $this->method = 'edit';
            } else {
                $this->method = 'index';
            }
        } 

        // Handle checkout routing
        else if (isset($url[0]) && strtolower($url[0]) == 'checkout') {
            $this->controller = 'OrderController';
            if (isset($url[1]) && strtolower($url[1]) == 'placeOrder') {
                $this->method = 'placeOrder';
            } else if (isset($url[1]) && strtolower($url[1]) == 'thankyou') {
                $this->method = 'thankYou';
            } else {
                $this->method = 'index';
            }
        } 

        // Handle product category routing (mens, womens, accessories)
        else if (isset($url[0]) && in_array(strtolower($url[0]), ['mens', 'womens', 'accessories'])) {
            $this->controller = 'ProductController';
            $this->method = strtolower($url[0]);
        } 

        // Handle blog routing
        else if (isset($url[0]) && strtolower($url[0]) == 'blogs') {
            $this->controller = 'BlogController';
            if (isset($url[1]) && strtolower($url[1]) == 'view' && isset($url[2])) {
                $this->method = 'view';
                $this->params = [$url[2]];
            } else {
                $this->method = 'list';
            }
        }

        // Default routing (home page)
        else if (!isset($url[0]) || strtolower($url[0]) == '') {
            $this->controller = 'HomeController';
            $this->method = 'index';
        }

        // Handle other controllers
        else if (file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
        }

        // Include the controller file
        if (file_exists('../app/controllers/' . $this->controller . '.php')) {
            require_once '../app/controllers/' . $this->controller . '.php';
        } else {
            die("Controller file not found: " . $this->controller . '.php');
        }

        $this->controller = new $this->controller;

        // Check if method exists in the controller
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        // Capture view output into $content
        ob_start();  // Start output buffering
        call_user_func_array([$this->controller, $this->method], $this->params);
        $content = ob_get_clean();  // Get the content and clean the buffer

        // Load the layout and pass the view content to it
        require_once '../app/views/' . $this->layout . '.php';
    }

    // Parse the URL
    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
