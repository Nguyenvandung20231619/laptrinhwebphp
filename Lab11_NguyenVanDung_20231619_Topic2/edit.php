<?php
require 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// 1. Lấy dữ liệu hiện tại của nhân viên
$stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->execute([$id]);
$employee = $stmt->fetch();

if (!$employee) {
    die("Không tìm thấy nhân viên!");
}

$errors = [];

// 2. Xử lý khi người dùng nhấn nút Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $position = trim($_POST['position']);
    $salary = $_POST['salary'];
    $status = $_POST['status'];

    // --- VALIDATION SERVER-SIDE ---
    if (strlen($full_name) < 3 || strlen($full_name) > 120) {
        $errors['full_name'] = "Họ tên phải từ 3-120 ký tự.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không đúng định dạng.";
    }
    if (empty($position)) {
        $errors['position'] = "Chức vụ không được để trống.";
    }
    if ($salary !== "" && (!is_numeric($salary) || $salary < 0)) {
        $errors['salary'] = "Lương phải là số không âm.";
    }

    // Kiểm tra email trùng (loại trừ email của chính nhân viên đang sửa)
    $stmt = $pdo->prepare("SELECT id FROM employees WHERE email = ? AND id != ?");
    $stmt->execute([$email, $id]);
    if ($stmt->fetch()) {
        $errors['email'] = "Email này đã được sử dụng bởi nhân viên khác.";
    }

    // 3. Nếu không có lỗi thì tiến hành Update
    if (empty($errors)) {
        $sql = "UPDATE employees 
                SET full_name = ?, email = ?, position = ?, salary = ?, status = ? 
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$full_name, $email, $position, $salary ?: 0, $status, $id]);

        $_SESSION['flash'] = "Cập nhật thông tin nhân viên thành công!";
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa nhân viên</title>
    <style>.error { color: red; font-size: 0.9em; }</style>
</head>
<body>
    <h3>Chỉnh sửa thông tin nhân viên (ID: <?= $id ?>)</h3>
    
    <form method="POST">
        <div>
            <label>Họ tên:</label><br>
            <input type="text" name="full_name" value="<?= htmlspecialchars($_POST['full_name'] ?? $employee['full_name']) ?>">
            <p class="error"><?= $errors['full_name'] ?? '' ?></p>
        </div>

        <div>
            <label>Email:</label><br>
            <input type="text" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $employee['email']) ?>">
            <p class="error"><?= $errors['email'] ?? '' ?></p>
        </div>

        <div>
            <label>Chức vụ:</label><br>
            <input type="text" name="position" value="<?= htmlspecialchars($_POST['position'] ?? $employee['position']) ?>">
            <p class="error"><?= $errors['position'] ?? '' ?></p>
        </div>

        <div>
            <label>Lương:</label><br>
            <input type="number" name="salary" value="<?= htmlspecialchars($_POST['salary'] ?? $employee['salary']) ?>">
            <p class="error"><?= $errors['salary'] ?? '' ?></p>
        </div>

        <div>
            <label>Trạng thái:</label><br>
            <?php $current_status = $_POST['status'] ?? $employee['status']; ?>
            <select name="status">
                <option value="1" <?= $current_status == 1 ? 'selected' : '' ?>>Đang làm việc</option>
                <option value="0" <?= $current_status == 0 ? 'selected' : '' ?>>Đã nghỉ việc</option>
            </select>
        </div>

        <br>
        <button type="submit">Update (Lưu thay đổi)</button>
        <a href="index.php">Back to List</a>
    </form>
</body>
</html>