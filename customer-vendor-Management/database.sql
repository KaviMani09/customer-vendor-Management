-- Create the database
CREATE DATABASE IF NOT EXISTS management;
USE management;

-- Create Customers table
CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(50),
    address TEXT,
    profileimage VARCHAR(255),      -- Stores URL or path to profile image
    purchasehistory TEXT,
    feedback TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Vendors table
CREATE TABLE IF NOT EXISTS vendors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(50),
    address TEXT,
    profileimage VARCHAR(255),      -- Stores URL or path to profile image
    company_name VARCHAR(255),
    product_service TEXT,
    contract_start DATE,
    contract_end DATE,
    payment_terms TEXT,
    feedback TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
