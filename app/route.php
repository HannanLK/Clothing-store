<?php

$routes = [
    // Home Page
    '' => 'HomeController@index',

    // Navigating Pages for Customers
    'mens' => 'ProductController@mens',
    'womens' => 'ProductController@womens',
    'accessories' => 'ProductController@accessories',

    'product/details' => 'ProductController@details',

    // Blog routes
    'blogs' => 'BlogController@list',  // Route for blog listing page

    // Cart routes
    'cart' => 'CartController@index',          // Display the cart
    'cart/addToCart' => 'CartController@addToCart', // Add item to cart
    'cart/updateQuantity' => 'CartController@updateQuantity', // Update item quantity
    'cart/removeItem' => 'CartController@removeItem', // Remove item from cart

    // Auth routes (Login and Registration handled by AuthController)
    'auth' => 'AuthController@index',                    // Route for login/register toggle page
    'auth/login' => 'AuthController@login',              // Login submission
    'auth/register' => 'AuthController@register',        // Register submission
    'auth/logout' => 'AuthController@logout',            // Logout action
    'auth/checkLoginStatus' => 'AuthController@checkLoginStatus',  // Check login status via AJAX or similar

    // Profile routes
    'profile' => 'ProfileController@index',                // Route for profile page
    'profile/edit' => 'ProfileController@edit',            // Route for editing profile

    // Checkout routes
    'checkout' => 'CheckoutController@index',              // Checkout page
    'checkout/placeOrder' => 'OrderController@placeOrder', // Route for placing the order
    'checkout/thankyou' => 'OrderController@thankYou',     // Route for showing the thank you message

    // Admin product management routes
    'admin/dashboard' => 'AdminController@dashboard',    // Admin dashboard
    'admin/products' => 'AdminController@products',      // General product management
    'admin/mens' => 'AdminController@mens',              // Men's product management
    'admin/womens' => 'AdminController@womens',          // Women's product management
    'admin/accessories' => 'AdminController@accessories',// Accessories product management
    'admin/addProduct' => 'AdminController@addProduct',  // Add product form
    'admin/editProduct' => 'AdminController@editProduct',// Edit product form
    
    // Blog management routes
    'admin/blogs' => 'AdminController@blogs',              // Blog management page
    'admin/addOrEditBlog' => 'AdminController@addOrEditBlog', // Add or Edit blog form
    'admin/deleteBlog' => 'AdminController@deleteBlog', 

    // User management routes
    'admin/users' => 'UserController@users',         // Manage users page
    'admin/addUser' => 'UserController@addUser',   // Add user form submission
    'admin/editUser' => 'UserController@editUser',   // Edit user form submission
    'admin/deleteUser' => 'UserController@deleteUser', // Delete user action

    // Inquiry management routes
    'admin/inquiries' => 'InquiryController@inquiries',         // Inquiry management page
    'admin/addInquiry' => 'InquiryController@addInquiry',       // Add new inquiry
    'admin/editInquiry' => 'InquiryController@editInquiry',     // Edit inquiry details
    'admin/deleteInquiry' => 'InquiryController@deleteInquiry', // Delete inquiry
    'admin/updateStatus' => 'InquiryController@updateStatus',   // Update inquiry status
];

