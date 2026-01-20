<?php
$host = 'localhost';
$db   = 'lab10_library';
$user = 'root';
$pass = ''; // Thay đổi theo config của bạn
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // Không hiện lỗi SQL ra màn hình theo yêu cầu
     error_log($e->getMessage());
     die("Lỗi kết nối cơ sở dữ liệu.");
}