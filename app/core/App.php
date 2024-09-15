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
        } else if (isset($url[0]) && in_array(strtolower($url[0]), ['mens', 'womens', 'accessories'])) {
            $this->controller = 'ProductController';
        } else if (isset($url[0]) && strtolower($url[0]) == 'cart') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /clothing-store/public/login');
                exit;
            }
            $this->controller = 'CartController';
        } else if (isset($url[0]) && strtolower($url[0]) == 'login') {
            $this->controller = 'LoginController';
        } else if (isset($url[0]) && strtolower($url[0]) == 'logout') {
            $this->controller = 'LoginController';
            $this->method = 'logout';
        } else if (isset($url[0]) && strtolower($url[0]) == 'products') {
            $this->controller = 'ProductController';
        } else if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
        }

        if (file_exists('../app/controllers/' . $this->controller . '.php')) {
            require_once '../app/controllers/' . $this->controller . '.php';
        } else {
            die("Controller file not found: " . $this->controller . '.php');
        }

        $this->controller = new $this->controller;

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
