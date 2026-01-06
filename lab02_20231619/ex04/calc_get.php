<?php
    if (!isset($_GET['a']) || !isset($_GET['b']) || !isset($_GET['op'])) {
        echo "<b>Hướng dẫn:</b> Truy cập URL theo mẫu: <br>";
        echo "<i>?a=10&b=2&op=add</i> (Các phép toán: add, sub, mul, div)";
        exit;
    }

    $a = (float)$_GET['a']; // Ép kiểu sang số thực
    $b = (float)$_GET['b'];
    $op = $_GET['op'];
    $result = 0;

    if ($op == 'div' && $b == 0) {
        echo "Lỗi: Không thể chia cho 0";
    } else {
        switch($op) {
            case 'add': $result = $a + $b; $label = "+"; break;
            case 'sub': $result = $a - $b; $label = "-"; break;
            case 'mul': $result = $a * $b; $label = "*"; break;
            case 'div': $result = $a / $b; $label = "/"; break;
            default: echo "Phép toán không hợp lệ"; exit;
        }
        echo "Kết quả: $a $label $b = $result";
    }
?>