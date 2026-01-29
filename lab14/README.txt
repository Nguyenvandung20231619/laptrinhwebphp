# Lab 14: CRUD + Pagination + Upload + PRG

### Hướng dẫn chạy:
1. Copy thư mục dự án vào `htdocs` (XAMPP).
2. Import file `database.sql` vào MySQL (phpMyAdmin).
3. Đảm bảo thư mục `public/uploads/` có quyền ghi (Write Permission).
4. Truy cập: `http://localhost/lab14/views/index.php`.

### Chức năng:
- **Topic 1:** Phân trang 5 bản ghi/trang, có ràng buộc trang hợp lệ.
- **Topic 2:** Upload ảnh (max 2MB, whitelist jpg/png/webp, đổi tên file).
- **Topic 3:** Flash Message + PRG (Post-Redirect-Get).