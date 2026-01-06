<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    
    if (empty($name) || empty($email)) {
        echo "<p style='color:red;'>Lỗi: Vui lòng nhập đầy đủ Họ tên và Email!</p>";
    } else {
        echo "<h3>Dữ liệu đã nhận:</h3><ul>";
        foreach ($_POST as $key => $value) {
            if (is_array($value)) $value = implode(", ", $value);
            echo "<li><strong>$key:</strong> " . htmlspecialchars($value) . "</li>";
        }
        echo "</ul>";
    }
}
?>

<form method="POST">
    Họ tên: <input type="text" name="name"><br>
    Email: <input type="email" name="email"><br>
    Giới tính: 
    <input type="radio" name="gender" value="Nam"> Nam
    <input type="radio" name="gender" value="Nữ"> Nữ <br>
    Sở thích:
    <input type="checkbox" name="hobby[]" value="Xem phim"> Xem phim
    <input type="checkbox" name="hobby[]" value="Thể thao"> Thể thao
    <input type="checkbox" name="hobby[]" value="Đọc sách"> Đọc sách <br>
    <button type="submit">Gửi</button>
</form>