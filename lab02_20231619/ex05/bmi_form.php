<h2>Tính chỉ số BMI - Nguyễn Văn Dũng (20231619)</h2>
<form method="GET">
    Họ tên: <input type="text" name="name" value="Nguyễn Văn Dũng"><br><br>
    Chiều cao (m): <input type="number" step="0.01" name="h" placeholder="Ví dụ: 1.7"><br><br>
    Cân nặng (kg): <input type="number" step="0.1" name="w" placeholder="Ví dụ: 62"><br><br>
    <button type="submit">Tính toán</button>
</form>

<?php
if (isset($_GET['h']) && isset($_GET['w'])) {
    $h = (float)$_GET['h'];
    $w = (float)$_GET['w'];
    $name = $_GET['name'] ?? "Khách";

    if ($h <= 0 || $w <= 0) {
        echo "<b style='color:red'>Vui lòng nhập số dương hợp lệ!</b>";
    } else {
        $bmi = round($w / ($h * $h), 2);
        $phanLoai = "";

        if ($bmi < 18.5) $phanLoai = "Gầy";
        elseif ($bmi < 24.9) $phanLoai = "Bình thường";
        elseif ($bmi < 29.9) $phanLoai = "Thừa cân";
        else $phanLoai = "Béo phì";

        echo "<h3>Kết quả cho sinh viên: $name</h3>";
        echo "Chỉ số BMI: <b>$bmi</b> <br>";
        echo "Phân loại: <b>$phanLoai</b>";
    }
}
?>