<?php
$a = isset($_GET['a']) ? $_GET['a'] : 4;
$b = isset($_GET['b']) ? $_GET['b'] : 3;

echo "<h3>Máy tính cơ bản:</h3>";
echo "Số a = $a, Số b = $b <br><br>";

if ($b != 0) {
    echo "Tổng: " . ($a + $b) . "<br>";
    echo "Hiệu: " . ($a - $b) . "<br>";
    echo "Tích: " . ($a * $b) . "<br>";
    echo "Thương: " . ($a / $b) . "<br>";
} else {
    echo "Lưu ý: Không thể thực hiện phép chia cho 0.";
}
?>