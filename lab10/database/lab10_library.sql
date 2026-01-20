-- 1. Tạo Database
CREATE DATABASE lab10_library CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lab10_library;

-- 2. Bảng Sách
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    author VARCHAR(120) NOT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0,
    qty INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Bảng Người mượn
CREATE TABLE borrowers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Bảng Phiếu mượn (Tổng quát)
CREATE TABLE borrows (
    id INT AUTO_INCREMENT PRIMARY KEY,
    borrower_id INT NOT NULL,
    borrow_date DATE NOT NULL,
    note VARCHAR(255),
    FOREIGN KEY (borrower_id) REFERENCES borrowers(id) ON DELETE CASCADE
);

-- 5. Bảng Chi tiết mượn (N-N giữa Borrows và Books)
CREATE TABLE borrow_items (
    borrow_id INT NOT NULL,
    book_id INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (borrow_id, book_id),
    FOREIGN KEY (borrow_id) REFERENCES borrows(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

-- Dữ liệu mẫu
INSERT INTO books (title, author, price, qty) VALUES 
('Lập trình PHP', 'Trần Nguyên Hoàng', 150000, 10),
('Cấu trúc dữ liệu', 'Nguyễn Văn A', 120000, 5),
('Cơ sở dữ liệu', 'Lê Thị B', 200000, 8);

INSERT INTO borrowers (full_name, phone) VALUES 
('Nguyễn Văn Dũng', '0987654321'),
('Trần Thị Hoa', '0123456789');