<?php
session_start();
header("Content-Type: application/json");
require_once '../helpers/session_helper.php';
require_once '../config/database.php';
require_once '../models/Product.php';

$db = (new Database())->getConnection();
$product = new Product($db);

$id = $_POST['id'] ?? null;
$code = $_POST['code'] ?? '';
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? 0;
$image_name = null;

// TOPIC 2: Xử lý file ảnh
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    
    if (in_array($ext, $allowed) && $_FILES['image']['size'] <= 2 * 1024 * 1024) {
        $image_name = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../public/uploads/" . $image_name);
        
        // Xóa ảnh cũ nếu là cập nhật
        if ($id) {
            $old = $product->getOne($id);
            if ($old && $old['image'] != 'default.png' && file_exists("../public/uploads/" . $old['image'])) {
                unlink("../public/uploads/" . $old['image']);
            }
        }
    }
}

try {
    if ($id) {
        $res = $product->update($id, $code, $name, $price, $image_name);
        $msg = "Cập nhật sản phẩm thành công!";
    } else {
        $res = $product->create($code, $name, $price, $image_name ?? 'default.png');
        $msg = "Thêm sản phẩm thành công!";
    }

    if ($res) {
        // TOPIC 3: Flash Message
        $_SESSION['flash_message'] = $msg;
        echo json_encode(["success" => true]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}