CREATE DATABASE IF NOT EXISTS inventory_db;
USE inventory_db;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) DEFAULT 'default.png',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dữ liệu mẫu để test phân trang (ít nhất 10 bản ghi)
INSERT INTO products (code, name, price, image) VALUES
('P001', 'iPhone 15 Pro', 25000000, 'default.png'),
('P002', 'Samsung S24 Ultra', 23000000, 'default.png'),
('P003', 'MacBook Air M2', 28000000, 'default.png'),
('P004', 'Logitech MX Master 3S', 2500000, 'default.png'),
('P005', 'Keychron K2 V2', 1800000, 'default.png'),
('P006', 'Dell XPS 13', 35000000, 'default.png'),
('P007', 'Sony WH-1000XM5', 8500000, 'default.png'),
('P008', 'iPad Pro M4', 32000000, 'default.png'),
('P009', 'Apple Watch Series 9', 10500000, 'default.png'),
('P010', 'Asus ROG Zephyrus', 45000000, 'default.png');