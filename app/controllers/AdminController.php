<?php

class AdminController extends Controller {

    private $productModel;
    private $userModel;
    private $blogModel;
    private $orderModel;
    private $inquiryModel;

    public function __construct() {
        $this->productModel = $this->model('ProductModel');
        $this->userModel = $this->model('UserModel');
        $this->blogModel = $this->model('BlogModel');
        $this->orderModel = $this->model('OrderModel');
        $this->inquiryModel = $this->model('InquiryModel');
    }


    public function dashboard() {
        $productCount = $this->productModel->getProductCount();
        $mensCount = $this->productModel->getProductCountByCategory('mens');
        $womensCount = $this->productModel->getProductCountByCategory('womens');
        $accessoriesCount = $this->productModel->getProductCountByCategory('accessories');
        $userCount = $this->userModel->getUserCount();
        $adminCount = $this->userModel->getAdminCount();
        $customerCount = $this->userModel->getCustomerCount();
        $blogCount = $this->blogModel->getBlogCount();
        $salesRevenue = $this->orderModel->getSalesRevenue();
        $pendingInquiryCount = $this->inquiryModel->getPendingInquiryCount();
        $inquiryCount = $this->inquiryModel->getInquiryCount();
        $sales = $this->orderModel->getAllSales();
    
        $this->renderView('admin/dashboard', [
            'productCount' => $productCount,
            'mensCount' => $mensCount,
            'womensCount' => $womensCount,
            'accessoriesCount' => $accessoriesCount,
            'userCount' => $userCount,
            'adminCount' => $adminCount,
            'customerCount' => $customerCount,
            'blogCount' => $blogCount,
            'salesRevenue' => $salesRevenue,
            'pendingInquiryCount' => $pendingInquiryCount,
            'inquiryCount' => $inquiryCount,
            'sales' => $sales
        ]);
    }
    

    // Helper method to fetch sorted products with optional stock filter
    private function getSortedProducts($category) {
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'date_new';  // Default sort option
        $stockFilter = isset($_GET['stock']) ? $_GET['stock'] : null;     // Optional stock filter
        
        // Pass both sort and stock options to the ProductModel
        return $this->model('ProductModel')->getSortedProductsByCategory($category, $sortOption, $stockFilter);
    }

    // Women's product management with stock filter and sorting
    public function womens() {
        $products = $this->getSortedProducts('womens');  // Use the updated helper method
        $this->renderView('admin/womensProducts', ['products' => $products, 'sortOption' => isset($_GET['sort']) ? $_GET['sort'] : 'date_new']);
    }

    // Accessories product management with stock filter and sorting
    public function accessories() {
        $products = $this->getSortedProducts('accessories');  // Use the updated helper method
        $this->renderView('admin/accessoriesProducts', ['products' => $products, 'sortOption' => isset($_GET['sort']) ? $_GET['sort'] : 'date_new']);
    }

    // General product management
    public function products() {
        $products = $this->model('ProductModel')->getAllProducts();
        $this->renderView('admin/products', ['products' => $products]);
    }

    // Men's product management with stock filter and sorting
    public function mens() {
        $products = $this->getSortedProducts('mens');  // Use the updated helper method
        $this->renderView('admin/mensProducts', ['products' => $products, 'sortOption' => isset($_GET['sort']) ? $_GET['sort'] : 'date_new']);
    }

    // Add product form
    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars(trim($_POST['name']));
            $price = htmlspecialchars(trim($_POST['price']));
            $quantity = (int)$_POST['quantity'];  // Get quantity
            $description = htmlspecialchars(trim($_POST['description']));
            $category = htmlspecialchars(trim($_POST['category']));

            $imageFolder = $this->determineImageFolder($category);
            $imageName = $this->handleImageUpload($imageFolder);

            if ($imageName) {
                $this->model('ProductModel')->addProduct($name, $category, $price, $quantity, $description, $imageName);
                $this->redirectToCategoryPage($category);
            } else {
                echo "Failed to upload the image.";
            }
        }
    }

    // Edit product
    public function editProduct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = htmlspecialchars(trim($_POST['id']));
            $name = htmlspecialchars(trim($_POST['name']));
            $price = htmlspecialchars(trim($_POST['price']));
            $quantity = (int)$_POST['quantity'];  // Get quantity
            $description = htmlspecialchars(trim($_POST['description']));
            $category = htmlspecialchars(trim($_POST['category']));

            $imageFolder = $this->determineImageFolder($category);
            $imageName = $this->handleImageUpload($imageFolder);

            if ($imageName) {
                $this->model('ProductModel')->updateProduct($id, $name, $category, $price, $quantity, $description, $imageName);
            } else {
                $this->model('ProductModel')->updateProduct($id, $name, $category, $price, $quantity, $description);
            }

            $this->redirectToCategoryPage($category);
        }
    }

    // // Delete product
    // public function deleteProduct() {
    //     if (isset($_GET['id'])) {
    //         $id = htmlspecialchars($_GET['id']);
    //         $product = $this->model('ProductModel')->getProductById($id);
    //         $this->model('ProductModel')->deleteProduct($id);
    //         $this->redirectToCategoryPage($product['category']);
    //     }
    // }

    public function deleteProduct() {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            $product = $this->model('ProductModel')->getProductById($id);
    
            // First, delete all related cart items
            $this->model('CartModel')->deleteItemsByProductId($id);
    
            // Then, delete the product
            $this->model('ProductModel')->deleteProduct($id);
    
            // Redirect back to the category page
            $this->redirectToCategoryPage($product['category']);
        }
    }
    

    // Helper method to determine image folder for products
    private function determineImageFolder($category) {
        switch ($category) {
            case 'mens':
                return '../public/images/mens/';
            case 'womens':
                return '../public/images/womens/';
            case 'accessories':
                return '../public/images/accessories/';
            default:
                return null;
        }
    }

    // Handle image uploads
    private function handleImageUpload($type) {
        if (!empty($_FILES['image']['name'])) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $imageName = $_FILES['image']['name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            if (in_array($imageExtension, $allowedExtensions)) {
                $imageFolder = "../public/images/{$type}/";
                $imagePath = $imageFolder . basename($imageName);
                move_uploaded_file($imageTmpName, $imagePath);
                return $imageName;
            } else {
                echo "Invalid file type. Only .jpg, .jpeg, and .png files are allowed.";
            }
        }
        return null;
    }

    // Method to fetch and display all blogs
    public function blogs() {
        // Fetch all blogs from the BlogModel
        $blogs = $this->model('BlogModel')->getAllBlogs();
        
        // Pass the blogs data to the view
        $this->renderView('admin/blogs', ['blogs' => $blogs]);
    }

    // Add Blog
    public function addBlog() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $data = [
                'title' => htmlspecialchars(trim($_POST['title'])),
                'content' => htmlspecialchars(trim($_POST['content'])),
                'author' => htmlspecialchars(trim($_POST['author'])),
                'summary' => htmlspecialchars(trim($_POST['summary'])),
                'image' => $this->handleImageUpload('blog')  // Handle image upload
            ];

            // Add new blog
            $this->model('BlogModel')->addBlog($data);

            // Redirect to the blogs page after submission
            header('Location: /clothing-store/public/admin/blogs');
            exit();
        }
    }

    // Edit Blog
    public function editBlog() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input
            $data = [
                'title' => htmlspecialchars(trim($_POST['title'])),
                'content' => htmlspecialchars(trim($_POST['content'])),
                'author' => htmlspecialchars(trim($_POST['author'])),
                'summary' => htmlspecialchars(trim($_POST['summary'])),
                'image' => $this->handleImageUpload('blog')  // Handle image upload
            ];

            // Edit blog if ID is provided
            if (!empty($_POST['blog_id'])) {
                $this->model('BlogModel')->updateBlog($_POST['blog_id'], $data);
            }

            // Redirect to the blogs page after editing
            header('Location: /clothing-store/public/admin/blogs');
            exit();
        }
    }

    // Delete Blog
    public function deleteBlog() {
        if (isset($_GET['id'])) {
            $this->model('BlogModel')->deleteBlog($_GET['id']);
            header('Location: /clothing-store/public/admin/blogs');
        }
    }

    // Redirect helper method for product categories
    private function redirectToCategoryPage($category) {
        switch ($category) {
            case 'mens':
                header('Location: /clothing-store/public/admin/mens');
                break;
            case 'womens':
                header('Location: /clothing-store/public/admin/womens');
                break;
            case 'accessories':
                header('Location: /clothing-store/public/admin/accessories');
                break;
            default:
                header('Location: /clothing-store/public/admin/products');
                break;
        }
        exit;
    }
}
