<?php
require 'config.php';
$errors = [];
$data = ['full_name' => '', 'email' => '', 'position' => '', 'salary' => '', 'status' => 1];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    // Validation
    if (strlen($data['full_name']) < 3 || strlen($data['full_name']) > 120) $errors['full_name'] = "Họ tên từ 3-120 ký tự.";
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = "Email không đúng định dạng.";
    if (empty($data['position'])) $errors['position'] = "Chức vụ là bắt buộc.";
    if ($data['salary'] !== "" && (!is_numeric($data['salary']) || $data['salary'] < 0)) $errors['salary'] = "Lương phải là số >= 0.";
    
    // Check Unique Email
    $check = $pdo->prepare("SELECT id FROM employees WHERE email = ?");
    $check->execute([$data['email']]);
    if ($check->fetch()) $errors['email'] = "Email đã tồn tại.";

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO employees (full_name, email, position, salary, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['full_name'], $data['email'], $data['position'], $data['salary'] ?: 0, $data['status']]);
        set_flash("Thêm mới thành công!");
        header("Location: index.php"); exit;
    }
}
?>

<h3>Thêm nhân viên</h3>
<form method="POST">
    Tên: <input type="text" name="full_name" value="<?= htmlspecialchars($data['full_name']) ?>">
    <small style="color:red"><?= $errors['full_name'] ?? '' ?></small><br><br>

    Email: <input type="text" name="email" value="<?= htmlspecialchars($data['email']) ?>">
    <small style="color:red"><?= $errors['email'] ?? '' ?></small><br><br>

    Chức vụ: <input type="text" name="position" value="<?= htmlspecialchars($data['position']) ?>">
    <small style="color:red"><?= $errors['position'] ?? '' ?></small><br><br>

    Lương: <input type="number" name="salary" value="<?= htmlspecialchars($data['salary']) ?>">
    <small style="color:red"><?= $errors['salary'] ?? '' ?></small><br><br>

    Trạng thái: 
    <select name="status">
        <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Đang làm</option>
        <option value="0" <?= $data['status'] == 0 ? 'selected' : '' ?>>Nghỉ việc</option>
    </select><br><br>

    <button type="submit">Save</button>
    <a href="index.php">Back to list</a>
</form>