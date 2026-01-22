HƯỚNG DẪN CHẠY DỰ ÁN - LAB 11
--------------------------------------
1. Cấu hình Database:
   - Mở PHPMyAdmin, tạo database tên là 'employee_db'.
   - Import file 'database.sql' đính kèm vào database vừa tạo.

2. Cấu hình Code:
   - Copy thư mục dự án vào 'htdocs' (XAMPP).
   - Kiểm tra file 'config.php' để chỉnh sửa username/password MySQL nếu cần (mặc định là root/'').

3. Đường dẫn chạy thử:
   - http://localhost/Lab11_NguyenVanDung_20231619_Topic2/index.php

4. Các chức năng đã hoàn thiện:
   - CRUD (Thêm, Sửa, Xóa, Liệt kê) dùng PDO.
   - Tìm kiếm theo Tên và Email.
   - Validate Server-side đầy đủ.
   - Chống XSS và Flash Message.