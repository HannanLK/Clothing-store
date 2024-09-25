# Folder - Structure of the Project
/server
│
├── /app
│   ├── /config                        # Configuration file (for database connection)
│   ├── /controllers                   # Controllers for handling requests
│   │   ├── AdminController.php        # Handle (CRUD for Products and Blogs)
|   |   ├── AuthController.php         # Handle User Authentication and Registration
│   │   ├── BlogController.php         # Blog-related logic (Viewing)
│   │   ├── CartController.php         # Cart-related logic
│   │   ├── CheckoutController.php     # Contact page logic
│   │   ├── Customer Controller.php    # Fetching details of customer's orders
│   │   ├── HomeController.php         # Home page logic
│   │   ├── InquiryController.php      # Handle inquiries logics
│   │   ├── OrderController.php        # Handle Order Logics
│   │   ├── ProductController.php      # Handles products CRUD and sub-categories
│   │   ├── ProfileController.php      # Profile (user login, management) logic
│   │   ├── UserController.php         # Handle Admin and Customer logics
│   ├── /core                          # Core files (main classes for app execution)
│   │   ├── App.php                    # Core app class handling routing
│   │   ├── Controller.php             # Base controller class
│   │   ├── Database.php               # Database handling logic
│   ├── /models
│   │   ├── BlogModel.php              # Handles blog data
│   │   ├── CartModel.php              # Hadles Cart Data
│   │   ├── InquiryModel.php           # Handles inquiry data
│   │   ├── OrderModel.php             # Handles Order data            
│   │   ├── ProductModel.php           # Handles all product data (including categories/sub-categories)
│   │   ├── UserModel.php              # Handles user data
│   ├── /views                         # Views for rendering HTML content
│   │   ├── /layouts                   # Shared layouts (admin and user)
│   │   │   ├── admin.php              # Admin layout
│   │   │   └── user.php               # User layout
│   │   ├── /home                      # Views for the home page
│   │   │   └── index.php
│   │   ├── /products                  # Views for products (with sub-categories)
│   │   │   ├── /mens                  # Men's category
│   │   │   │   ├── index.php          # Men's product page (shirts, trousers, etc.)
│   │   │   ├── /womens                # Women's category
│   │   │   │   ├── index.php          # Women's product page (skirts, blouses, etc.)
│   │   │   ├── /accessories           # Accessories category
│   │   │   │   ├── index.php          # Accessories product page (wallets, belts, etc.)
│   │   ├── /blog                      # Views for blogs
│   │   │   └── index.php
│   │   ├── /contact                   # Views for contact page
│   │   │   └── index.php
│   │   ├── /profile                   # Views for profile page (login, user details)
│   │   │   └── index.php
│   │   ├── /cart                      # Views for cart page
│   │   │   └── index.php
│   │   ├── /admin                     # Views for admin panel
│   │   │   ├── dashboard.php          # Admin dashboard
│   │   │   ├── products.php           # Admin product management (all categories)
│   │   │   ├── addProduct.php         # Admin add product form
│   │   │   ├── editProduct.php        # Admin edit product form
│   │   │   ├── categories.php         # Admin category management
│   │   │   ├── addCategory.php        # Admin add category form
│   │   │   ├── editCategory.php       # Admin edit category form
│   │   │   ├── users.php              # Admin user management
│   │   │   └── blogs.php              # Admin blog management
│   └── route.php                      # Routing logic
│
└── /public
    ├── /css                           # Stylesheets for the application
    ├── /js                            # JavaScript files for the application
    └── index.php                      # Entry point for the app

