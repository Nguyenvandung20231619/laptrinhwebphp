CREATE DATABASE IF NOT EXISTS employee_db;
USE employee_db;

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    phone VARCHAR(20) NULL,
    position VARCHAR(80) NOT NULL,
    salary INT DEFAULT 0,
    status TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Chèn 5 bản ghi mẫu
INSERT INTO employees (full_name, email, phone, position, salary, status) VALUES
('Nguyen Van A', 'vana@gmail.com', '0912345678', 'Developer', 15000000, 1),
('Tran Thi B', 'thib@gmail.com', '0987654321', 'Designer', 12000000, 1),
('Le Van C', 'vanc@gmail.com', '0905111222', 'Manager', 25000000, 1),
('Pham Thi D', 'thid@gmail.com', '0933444555', 'Tester', 10000000, 0),
('Hoang Van E', 'vane@gmail.com', '0944555666', 'HR', 11000000, 1);