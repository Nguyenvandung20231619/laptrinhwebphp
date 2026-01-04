<?php
require_once 'functions.php';

// Giả sử ta nhận dữ liệu từ URL hoặc Form, ở đây tôi demo dữ liệu mẫu
$choice = $_GET['action'] ?? 'menu'; 
$val1 = $_GET['a'] ?? 10;
$val2 = $_GET['b'] ?? 5;
$n = $_GET['n'] ?? 7;

echo "<h2>lab03-Mini Utility + Menu</h2>";
echo "<ul>
        <li><a href='?action=max'>Tìm Max (10, 5)</a></li>
        <li><a href='?action=prime'>Kiểm tra số nguyên tố (7)</a></li>
        <li><a href='?action=factorial'>Tính giai thừa (5)</a></li>
        <li><a href='?action=gcd'>Tìm ƯCLN (12, 18)</a></li>
      </ul>";

echo "<hr>";

switch ($choice) {
    case 'max':
        echo "Max của $val1 và $val2 là: " . max2($val1, $val2);
        break;

    case 'min':
        echo "Min của $val1 và $val2 là: " . min2($val1, $val2);
        break;

    case 'prime':
        if (isPrime($n)) {
            echo "$n là số nguyên tố.";
        } else {
            echo "$n không phải là số nguyên tố.";
        }
        break;

    case 'factorial':
        $num = 5;
        echo "Giai thừa của $num là: " . factorial($num);
        break;

    case 'gcd':
        $a = 12; $b = 18;
        echo "ƯCLN của $a và $b là: " . gcd($a, $b);
        break;

    case 'menu':
        echo "Vui lòng chọn một chức năng từ menu phía trên.";
        break;

    default:
        echo "Chức năng không tồn tại.";
        break;
}
?>