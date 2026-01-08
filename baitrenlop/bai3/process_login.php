<?php
session_start();

// Lấy dữ liệu từ form
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Kiểm tra thông tin (Thực tế sẽ check trong Database)
if ($email === 'admin@gmail.com' && $password === '123456') {
    // Tạo session lưu thông tin user
    $_SESSION['user'] = $email;
    header("Location: dashboard.php");
} else {
    // Sai thông tin, trả về kèm lỗi
    header("Location: login.php?error=1");
}
exit();