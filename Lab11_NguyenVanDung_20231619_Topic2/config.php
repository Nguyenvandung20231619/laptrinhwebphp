<?php
session_start();
$host = 'localhost';
$db   = 'employee_db';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

// Hàm hỗ trợ hiển thị thông báo flash
function set_flash($msg) { $_SESSION['flash'] = $msg; }
function display_flash() {
    if (isset($_SESSION['flash'])) {
        echo "<div style='color: green; padding: 10px; border: 1px solid green; margin-bottom: 10px;'>{$_SESSION['flash']}</div>";
        unset($_SESSION['flash']);
    }
}
?>