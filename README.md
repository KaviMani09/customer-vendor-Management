# Customer-Vendor Management System

A web-based application for managing customer and vendor records, featuring CRUD operations, file uploads, and bulk import/export in CSV/Excel formats. Built with PHP, MySQL, and PhpSpreadsheet, it’s designed for small to medium-sized businesses to streamline data management.

## Table of Contents
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Database Schema](#database-schema)
- [Installation](#installation)
- [Usage](#usage)
- [Limitations and Future Enhancements](#limitations-and-future-enhancements)
- [License](#license)
- [Contributing](#contributing)
- [Contact](#contact)

## Features

### Customer Management
- **List View**: Displays customers with search/filter by name, email, or phone (`index.php`).
- **Create**: Add customers with fields for name, email, phone, address, profile image, purchase history, and feedback (`create.php`).
- **Update**: Edit customer details, including optional profile image updates (`update.php`).
- **View Profile**: Detailed customer view in a two-panel layout (`profile.php`).
- **Delete**: Remove customers with confirmation (`delete.php`).
- **Import/Export**: Bulk import from CSV/Excel and export to CSV/Excel (`import.php`, `export.php`).

### Vendor Management
- **List View**: Displays customers with search/filter by name, email, or phone (`index.php`).
- **Create**: Add customers with fields for name, email, phone, address, profile image, purchase history, and feedback (`create.php`).
- **Update**: Edit customer details, including optional profile image updates (`update.php`).
- **View Profile**: Detailed customer view in a two-panel layout (`profile.php`).
- **Delete**: Remove customers with confirmation (`delete.php`).
- **Import/Export**: Bulk import from CSV/Excel and export to CSV/Excel (`import.php`, `export.php`).

### General Features
- **Security**: Input sanitization, PDO for safe queries, and file upload validation (JPEG, PNG, GIF; max 5MB).
- **Messaging**: Session-based success/error messages.
- **Navigation**: Links between customer, vendor, and home pages.

## Technologies Used
- **Backend**: PHP 7+ with PDO for database interactions.
- **Database**: MySQL (database: `management`, table: `customers`).
- **Frontend**: HTML5, CSS, JavaScript.
- **Libraries**:
  - [PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) for CSV/Excel processing.
  - Composer for dependency management.
- **Security**: Sanitization (`htmlspecialchars`), whitelisted SQL filters, secure file uploads.

# Clone the repository
git clone https://github.com/your-username/customer-vendor-management.git

# Navigate to project directory
cd customer-vendor-management

# Install dependencies
composer install

## Database Schema
```sql
# Create MySQL database
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

