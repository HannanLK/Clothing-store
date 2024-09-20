<?php
class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    // Show the login/register toggle page
    public function index() {
        // If user is already logged in, redirect to profile or admin dashboard based on role
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] === 'admin') {
                header('Location: ' . BASE_URL . 'admin/dashboard');
            } else {
                header('Location: ' . BASE_URL . 'profile');
            }
            exit;
        }

        // Render the combined login/register view
        $this->renderView('auth/login_register');
    }

    // Handle login functionality
        // AuthController.php
    // public function login() {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $username = htmlspecialchars(trim($_POST['username']));
    //         $password = htmlspecialchars(trim($_POST['password']));

    //         // Authenticate the user
    //         $user = $this->userModel->authenticate($username, $password);

    //         if ($user) {
    //             // Set session variables
    //             $_SESSION['user_id'] = $user['user_id'];
    //             $_SESSION['username'] = $user['username'];
    //             $_SESSION['role'] = $user['role'];

    //             // If there is a guest cart stored in the session, transfer it to the user's cart
    //             if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    //                 $cartModel = $this->model('CartModel'); // Load the CartModel
    //                 foreach ($_SESSION['cart'] as $cartItem) {
    //                     // Ensure product_id is set
    //                     if (!isset($cartItem['product_id']) || $cartItem['product_id'] == null) {
    //                         // Handle missing product_id, for example, skip adding the item
    //                         continue;
    //                     }

    //                     // Add each session cart item to the database cart
    //                     $cartModel->addProductToCart(
    //                         $user['user_id'],
    //                         $cartItem['product_id'],  // Ensure this is not null
    //                         $cartItem['quantity']
    //                     );
    //                 }
    //                 // Clear the session cart after transferring to the database
    //                 unset($_SESSION['cart']);
    //             }

    //             // Redirect based on role
    //             if ($_SESSION['role'] === 'admin') {
    //                 header('Location: ' . BASE_URL . 'admin/dashboard');
    //             } else {
    //                 if (isset($_SESSION['redirect_url'])) {
    //                     $redirect_url = $_SESSION['redirect_url'];
    //                     unset($_SESSION['redirect_url']);
    //                     header("Location: $redirect_url");
    //                 } else {
    //                     header('Location: ' . BASE_URL . 'profile');
    //                 }
    //             }
    //             exit;
    //         } else {
    //             // Authentication failed
    //             $this->renderView('auth/login_register', ['error' => 'Invalid login credentials']);
    //         }
    //     } else {
    //         $this->renderView('auth/login_register');
    //     }
    // }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));
    
            // Authenticate the user
            $user = $this->userModel->authenticate($username, $password);
    
            if ($user) {
                // Set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
    
                // Merge session cart with database cart
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    $cartModel = $this->model('CartModel');
                    
                    foreach ($_SESSION['cart'] as $cartItem) {
                        $cartModel->addProductToCart(
                            $user['user_id'],
                            $cartItem['id'],  // Product ID from session cart
                            $cartItem['quantity']
                        );
                    }
    
                    // Clear session cart after merging with database
                    unset($_SESSION['cart']);
                }
    
                // Redirect user based on role
                if ($_SESSION['role'] === 'admin') {
                    header('Location: ' . BASE_URL . 'admin/dashboard');
                } else {
                    // Redirect to the checkout page if it was the intended destination
                    if (isset($_SESSION['redirect_url'])) {
                        $redirect_url = $_SESSION['redirect_url'];
                        unset($_SESSION['redirect_url']);
                        header("Location: $redirect_url");
                    } else {
                        header('Location: ' . BASE_URL . 'profile');
                    }
                }
                exit;
            } else {
                // Authentication failed
                $this->renderView('auth/login_register', ['error' => 'Invalid login credentials']);
            }
        } else {
            $this->renderView('auth/login_register');
        }
    }
    



    // Handle registration functionality
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and validate input
            $data = [
                'name' => htmlspecialchars(trim($_POST['name'])),
                'email' => filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL),
                'address' => htmlspecialchars(trim($_POST['address'])),
                'phone' => htmlspecialchars(trim($_POST['phone'])),
                'username' => htmlspecialchars(trim($_POST['username'])),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Hash password
                'role' => 'customer', // Default role set to 'customer'
                'created_at' => date('Y-m-d H:i:s')
            ];

            if (!$data['email']) {
                $this->renderView('auth/login_register', ['error' => 'Invalid email address.']);
                return;
            }

            // Add user to the database
            $result = $this->userModel->addUser($data);

            if (isset($result['error'])) {
                $this->renderView('auth/login_register', ['error' => $result['error']]);
            } else {
                // Automatically log in the user after successful registration
                $user = $this->userModel->authenticate($data['username'], $_POST['password']);
                if ($user) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    // Redirect to home page after registration
                    header('Location: ' . BASE_URL);
                    exit();
                }
            }
        } else {
            // Render the combined login/register form
            $this->renderView('auth/login_register');
        }
    }

    // Handle logout functionality
    public function logout() {
        // Clear the session and log the user out
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL);
        exit();
    }
}
