# Category Table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

# Product Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

# users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    address VARCHAR(255),
    phone VARCHAR(15),
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    role ENUM('customer', 'admin') DEFAULT 'customer'
);


# Orders Table
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,  -- Match the data type to users.user_id (INT)
    total DECIMAL(10,2),
    address VARCHAR(255),
    contact_number VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

# Order Items Table
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- Primary key for order items
    order_id INT,                       -- Foreign key referencing orders
    product_id INT,                     -- Foreign key referencing products
    quantity INT,                       -- Quantity of the product in the order
    price DECIMAL(10,2),                -- Price of the product at the time of the order
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,    -- Foreign key relation to orders
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE  -- Foreign key relation to products
);

# Sales Table
CREATE TABLE sales (
    id INT PRIMARY KEY AUTO_INCREMENT,      -- Primary key for sales
    order_id INT,                           -- Foreign key referencing orders
    revenue DECIMAL(10,2),                  -- Revenue generated from the sale
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp when the sale is recorded
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE  -- Foreign key relation to orders
);




