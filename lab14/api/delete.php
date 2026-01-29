<?php
require_once '../helpers/session_helper.php';
header("Content-Type: application/json");
require_once '../config/database.php';
require_once '../models/Product.php';

$db = (new Database())->getConnection();
$product = new Product($db);
$id = $_POST['id'] ?? null;

if ($id && $product->delete($id)) {
    set_flash("Đã xóa sản phẩm!");
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}