
CREATE DATABASE IF NOT EXISTS ql_thu_vien CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ql_thu_vien;
-- 1. Tạo bảng Categories
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- 2. Tạo bảng Publishers 
CREATE TABLE publishers (
    publisher_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- 3. Tạo bảng Books 
CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category_id INT,
    publisher_id INT,
    price DECIMAL(10, 2) CHECK (price > 0),
    published_year INT,
    stock INT CHECK (stock >= 0),
    CONSTRAINT fk_book_category FOREIGN KEY (category_id) REFERENCES categories(category_id),
    CONSTRAINT fk_book_publisher FOREIGN KEY (publisher_id) REFERENCES publishers(publisher_id)
);

-- 4. Tạo bảng Members
CREATE TABLE members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    phone VARCHAR(15) UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 5. Tạo bảng Loans 
CREATE TABLE loans (
    loan_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    loan_date DATE,
    due_date DATE,
    `status` ENUM('BORROWED', 'RETURNED', 'OVERDUE') DEFAULT 'BORROWED',
    CONSTRAINT fk_loan_member FOREIGN KEY (member_id) REFERENCES members(member_id) ON DELETE RESTRICT
);

-- 6. Tạo bảng Loan_items 
CREATE TABLE loan_items (
    loan_id INT,
    book_id INT,
    qty INT CHECK (qty > 0),
    PRIMARY KEY (loan_id, book_id),
    CONSTRAINT fk_item_loan FOREIGN KEY (loan_id) REFERENCES loans(loan_id) ON DELETE CASCADE,
    CONSTRAINT fk_item_book FOREIGN KEY (book_id) REFERENCES books(book_id)
);

-- Chèn Danh mục
INSERT INTO categories (name) VALUES ('Kinh tế'), ('Kỹ thuật'), ('Văn học'), ('Kỹ năng'), ('Ngoại ngữ');

-- Chèn Nhà xuất bản
INSERT INTO publishers (name) VALUES ('NXB Trẻ'), ('NXB Giáo Dục'), ('NXB Kim Đồng');

-- Chèn Sách (15 cuốn)
INSERT INTO books (title, category_id, publisher_id, price, published_year, stock) VALUES
('Đắc Nhân Tâm', 4, 1, 85000, 2020, 10),
('Nhà Giả Kim', 3, 1, 79000, 2019, 5),
('Lập trình C cơ bản', 2, 2, 120000, 2021, 15),
('Kinh tế học vi mô', 1, 2, 95000, 2018, 8),
('Doraemon', 3, 3, 25000, 2022, 50),
('English Grammar in Use', 5, 2, 150000, 2020, 12),
('Thanh gươm diệt quỷ', 3, 3, 45000, 2021, 30),
('Cấu trúc dữ liệu', 2, 2, 110000, 2021, 7),
('Tư duy nhanh và chậm', 1, 1, 180000, 2017, 4),
('Học cách học', 4, 2, 60000, 2020, 20),
('Mắt biếc', 3, 1, 110000, 2015, 6),
('SQL cho người mới', 2, 2, 99000, 2023, 10),
('Quản trị kinh doanh', 1, 1, 135000, 2019, 3),
('IELTS Practice Tests', 5, 2, 200000, 2022, 15),
('Dế Mèn Phiêu Lưu Ký', 3, 3, 55000, 2018, 25);

-- Chèn Thành viên (8 người)
INSERT INTO members (full_name, phone) VALUES
('Nguyễn Văn Dũng', '0912345678'), ('Lê Thị Mai', '0987654321'),
('Trần Văn An', '0905123456'), ('Phạm Thị Bình', '0934112233'),
('Hoàng Văn Cường', '0977889900'), ('Đặng Thu Thảo', '0888999000'),
('Bùi Minh Tuấn', '0966555444'), ('Ngô Bảo Châu', '0944333222');

-- Chèn Phiếu mượn (12 phiếu)
INSERT INTO loans (member_id, loan_date, due_date, status) VALUES
(1, '2025-12-20', '2025-12-27', 'RETURNED'),
(2, '2026-01-01', '2026-01-08', 'BORROWED'),
(3, '2026-01-05', '2026-01-12', 'OVERDUE'),
(1, '2026-01-10', '2026-01-17', 'BORROWED'),
(4, '2025-12-15', '2025-12-22', 'RETURNED'),
(5, '2026-01-08', '2026-01-15', 'BORROWED'),
(6, '2026-01-12', '2026-01-19', 'BORROWED'),
(1, '2026-01-14', '2026-01-21', 'BORROWED'),
(7, '2025-12-01', '2025-12-08', 'RETURNED'),
(8, '2026-01-02', '2026-01-09', 'OVERDUE'),
(2, '2026-01-11', '2026-01-18', 'BORROWED'),
(3, '2026-01-13', '2026-01-20', 'BORROWED');

-- Chèn Chi tiết mượn sách (25 dòng)
INSERT INTO loan_items (loan_id, book_id, qty) VALUES
(1, 1, 1), (1, 2, 1), (2, 3, 2), (2, 5, 1), (2, 12, 1),
(3, 4, 1), (3, 9, 1), (4, 1, 1), (4, 10, 2), (5, 15, 3),
(5, 5, 2), (6, 6, 1), (6, 14, 1), (7, 8, 1), (7, 12, 1),
(7, 3, 1), (8, 1, 1), (8, 2, 1), (9, 11, 1), (9, 15, 1),
(10, 13, 1), (10, 4, 1), (11, 7, 2), (11, 5, 5), (12, 1, 1);