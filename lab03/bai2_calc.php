<?php
$a = (float)($_GET["a"] ?? 0);
$b = (float)($_GET["b"] ?? 0);
$op = $_GET["op"] ?? "add";

echo "<h3>Máy tính Mini</h3>";
$result = 0;
$error = "";

switch ($op) {
    case "add": $result = $a + $b; $symbol = "+"; break;
    case "sub": $result = $a - $b; $symbol = "-"; break;
    case "mul": $result = $a * $b; $symbol = "*"; break;
    case "div":
        if ($b == 0) {
            $error = "Không chia được cho 0";
        } else {
            $result = $a / $b;
            $symbol = "/";
        }
        break;
    default: $error = "Phép toán không hợp lệ";
}

if ($error) {
    echo "Lỗi: $error";
} else {
    echo "Kết quả: $a $symbol $b = $result";
}
?>