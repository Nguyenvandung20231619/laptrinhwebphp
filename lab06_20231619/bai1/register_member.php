<?php
// Giải mã lỗi và dữ liệu cũ từ URL nếu có
$errors = isset($_GET['errors']) ? json_decode(base64_decode($_GET['errors']), true) : [];
$old = isset($_GET['old']) ? json_decode(base64_decode($_GET['old']), true) : [];

/**
 * Hàm hỗ trợ hiển thị dữ liệu cũ an toàn
 */
function v($field, $old) {
    return htmlspecialchars($old[$field] ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký thẻ thư viện - 20231619</title>
    <style>
        .error-box { color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px; background: #fff0f0; }
        .form-item { margin-bottom: 12px; }
        label { display: inline-block; width: 130px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>FORM ĐĂNG KÝ THẺ THƯ VIỆN</h2>

    <?php if ($errors): ?>
        <div class="error-box">
            <strong>Thông báo lỗi:</strong>
            <ul><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul>
        </div>
    <?php endif; ?>

    <form action="member_result.php" method="POST">
        <div class="form-item">
            <label>Họ tên (*):</label>
            <input type="text" name="fullname" value="<?= v('fullname', $old) ?>" required>
        </div>

        <div class="form-item">
            <label>Email (*):</label>
            <input type="email" name="email" value="<?= v('email', $old) ?>" required>
        </div>

        <div class="form-item">
            <label>Số điện thoại (*):</label>
            <input type="text" name="phone" value="<?= v('phone', $old) ?>" required placeholder="9-11 chữ số">
        </div>

        <div class="form-item">
            <label>Ngày sinh (*):</label>
            <input type="date" name="dob" value="<?= v('dob', $old) ?>" required>
        </div>

        <div class="form-item">
            <label>Giới tính:</label>
            <?php $g = $old['gender'] ?? 'Nam'; ?>
            <input type="radio" name="gender" value="Nam" <?= $g == 'Nam' ? 'checked' : '' ?>> Nam
            <input type="radio" name="gender" value="Nữ" <?= $g == 'Nữ' ? 'checked' : '' ?>> Nữ
            <input type="radio" name="gender" value="Khác" <?= $g == 'Khác' ? 'checked' : '' ?>> Khác
        </div>

        <div class="form-item">
            <label>Địa chỉ:</label><br>
            <textarea name="address" rows="3" cols="40"><?= v('address', $old) ?></textarea>
        </div>

        <button type="submit">Đăng ký</button>
        <button type="reset" onclick="window.location.href='register_member.php'">Nhập lại</button>
    </form>
</body>
</html>