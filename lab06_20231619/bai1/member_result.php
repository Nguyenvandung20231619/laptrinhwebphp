<?php
/**
 * 1. KIỂM TRA PHƯƠNG THỨC TRUY CẬP
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<h3>Lỗi: Truy cập trực tiếp không được phép!</h3>";
    echo "<a href='register_member.php'>Quay lại Form đăng ký</a>";
    exit;
}

/**
 * 2. TIẾP NHẬN DỮ LIỆU (Sử dụng gán mặc định để tránh Undefined Index)
 */
$fullname = trim($_POST['fullname'] ?? '');
$email    = trim($_POST['email'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$dob      = $_POST['dob'] ?? '';
$gender   = $_POST['gender'] ?? 'Nam';
$address  = trim($_POST['address'] ?? '');

$errors = [];

/**
 * 3. VALIDATION THEO YÊU CẦU
 */
if (empty($fullname)) $errors[] = "Bạn chưa nhập họ tên.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Định dạng email không chính xác.";

// Kiểm tra SĐT: chỉ gồm số và độ dài 9-11
if (empty($phone)) {
    $errors[] = "Bạn chưa nhập số điện thoại.";
} elseif (!preg_match('/^[0-9]{9,11}$/', $phone)) {
    $errors[] = "Số điện thoại chỉ bao gồm số và dài từ 9 đến 11 ký tự.";
}

if (empty($dob)) $errors[] = "Vui lòng chọn ngày sinh.";

/**
 * 4. XỬ LÝ KHI CÓ LỖI
 */
if (!empty($errors)) {
    $errStr = base64_encode(json_encode($errors));
    $oldData = base64_encode(json_encode($_POST));
    header("Location: register_member.php?errors=$errStr&old=$oldData");
    exit;
}

/**
 * 5. LƯU DỮ LIỆU VÀO CSV (Xử lý lỗi thư mục không tồn tại)
 */
$dataDir = '../data';
$csvPath = $dataDir . '/members.csv';

// Tự động tạo thư mục data nếu chưa có
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0777, true);
}

// Ghi dữ liệu vào file
$file = fopen($csvPath, 'a');
if ($file) {
    // fputcsv tự động xử lý các ký tự đặc biệt trong dữ liệu
    fputcsv($file, [$fullname, $email, $phone, $dob, $gender, $address]);
    fclose($file);
} else {
    die("Lỗi: Không thể mở file dữ liệu để ghi.");
}

/**
 * 6. HIỂN THỊ KẾT QUẢ (Chống XSS)
 */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết quả đăng ký - 20231619</title>
</head>
<body>
    <h2 style="color: green;">ĐĂNG KÝ THÀNH CÔNG!</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr><td><strong>Họ tên:</strong></td><td><?= htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><td><strong>Email:</strong></td><td><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><td><strong>Số điện thoại:</strong></td><td><?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><td><strong>Ngày sinh:</strong></td><td><?= htmlspecialchars($dob, ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><td><strong>Giới tính:</strong></td><td><?= htmlspecialchars($gender, ENT_QUOTES, 'UTF-8') ?></td></tr>
        <tr><td><strong>Địa chỉ:</strong></td><td><?= nl2br(htmlspecialchars($address, ENT_QUOTES, 'UTF-8')) ?></td></tr>
    </table>
    <br>
    <a href="register_member.php">Tiếp tục đăng ký thành viên mới</a>
</body>
</html>