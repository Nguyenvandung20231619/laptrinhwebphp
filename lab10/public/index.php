<?php
require_once '../app/config/db.php';

// Tự động nạp Controller và Repository dựa trên tên class
spl_autoload_register(function ($class) {
    if (strpos($class, 'Controller') !== false) {
        require_once "../app/controllers/$class.php";
    } elseif (strpos($class, 'Repository') !== false) {
        require_once "../app/models/$class.php";
    }
});

// Lấy tham số từ URL
$c = $_GET['c'] ?? 'books'; // Mặc định là controller books
$a = $_GET['a'] ?? 'index'; // Mặc định là action index

$controllerName = ucfirst($c) . 'Controller';

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $a)) {
        $controller->$a(); // Gọi hàm xử lý
    } else {
        die("Không tìm thấy chức năng: $a");
    }
} else {
    die("Không tìm thấy trang: $c");
}