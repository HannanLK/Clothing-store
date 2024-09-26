/server
│
├── /app
│   ├── /config                        # Configuration files (for database connection)
│   │   └── config.php                 # Database configuration and other app configurations
│   ├── /controllers                   # Controllers for handling requests
│   │   ├── AdminController.php        # Handle (CRUD for Products and Blogs)
│   │   ├── AuthController.php         # Handle User Authentication and Registration
│   │   ├── BlogController.php         # Blog-related logic (Viewing)
│   │   ├── CartController.php         # Cart-related logic
│   │   ├── CheckoutController.php     # Checkout page logic
│   │   ├── CustomerController.php     # Fetching details of customer's orders
│   │   ├── HomeController.php         # Home page logic
│   │   ├── InquiryController.php      # Handle inquiries logic
│   │   ├── OrderController.php        # Handle Order logic
│   │   ├── ProductController.php      # Handles products CRUD and sub-categories
│   │   ├── ProfileController.php      # Profile (user login, management) logic
│   │   ├── UserController.php         # Handle Admin and Customer logic
│   ├── /core                          # Core files (main classes for app execution)
│   │   ├── App.php                    # Core app class handling routing
│   │   ├── Controller.php             # Base controller class
│   │   ├── Database.php               # Database handling logic
│   ├── /models
│   │   ├── BlogModel.php              # Handles blog data
│   │   ├── CartModel.php              # Handles Cart Data
│   │   ├── InquiryModel.php           # Handles inquiry data
│   │   ├── OrderModel.php             # Handles Order data            
│   │   ├── ProductModel.php           # Handles all product data (including categories/sub-categories)
│   │   ├── UserModel.php              # Handles user data
│   ├── /views                         # Views for rendering HTML content
│   │   ├── /Customer                      # Customer view files
│   │   │   ├── accessories.php        # Accessories page
│   │   │   ├── blogs.php              # Blog page
│   │   │   ├── cart.php               # User cart page
│   │   │   ├── checkout.php           # Checkout page
│   │   │   ├── contact.php            # Contact page
│   │   │   ├── home.php               # Home page
│   │   │   ├── mens.php               # Men's collection page
│   │   │   ├── profile.php            # User profile page
│   │   │   ├── thankyou.php           # Thank you page after order
│   │   │   ├── womens.php             # Women's collection page
│   │   ├── /admin                         # Views for the admin panel
│   │   │   ├── accessoriesProduct.php # Admin Accessories Management
│   │   │   ├── blogs.php              # Admin Blog Management
│   │   │   ├── dashboard.php          # Admin dashboard
│   │   │   ├── inquiries.php          # Admin inquiries from the contact page
│   │   │   ├── mensProducts.php       # Admin mens product management
│   │   │   ├── users.php              # Admin user management
│   │   │   └── womensProduct.php      # Admin womens product management
│   │   ├── /auth                         # Views login register
│   │   │   ├── login_register.php     # User login and registration
│   │   ├── /layout                         # Navigation
│   │   │   ├── admin.php              # admin layout
│   │   │   ├── customer.php           # customers, headers and footer
│   └── route.php                      # Routing logic
│
└── /public
    ├── /css                           # Stylesheets for the application
    ├── /js                            # JavaScript files for the application
    ├── /images                        # Images used for the site
    │   ├── /banners                   # Banner images for different sections
    │   ├── /mens                      # Men's product images
    │   ├── /womens                    # Women's product images
    │   ├── /accessories               # Accessories product images
    │   └── /blog                      # Blog images
    └── index.php                      # Entry point for the app
