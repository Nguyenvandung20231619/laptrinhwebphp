<?php
require 'config.php';
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
    if ($stmt->execute([$id])) {
        set_flash("Xóa nhân viên thành công!");
    }
}
header("Location: index.php");
exit;
?>