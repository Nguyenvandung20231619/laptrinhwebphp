CREATE DATABASE IF NOT EXISTS it3220_php CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE it3220_php;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dob DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dữ liệu mẫu
INSERT INTO students (code, full_name, email, dob) VALUES 
('SV001', 'Nguyễn Văn Dũng', 'dung.nv231619@sis.hust.edu.vn', '2005-01-01'),
('SV002', 'Trần Thị Mai', 'mai.tt@gmail.com', '2005-05-15'),
('SV003', 'Lê Văn Tám', 'tam.lv@yahoo.com', '2004-10-20'),
('SV004', 'Phạm Minh Đức', 'duc.pm@outlook.com', '2005-12-30'),
('SV005', 'Hoàng Anh Thư', 'thu.ha@gmail.com', '2005-03-12');