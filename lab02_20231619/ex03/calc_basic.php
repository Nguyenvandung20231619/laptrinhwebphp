<?php
    $a = 10; $b = 3;
    
    echo "Số a = $a, số b = $b <br>";
    echo "Tổng: " . ($a + $b) . "<br>";
    echo "Hiệu: " . ($a - $b) . "<br>";
    echo "Tích: " . ($a * $b) . "<br>";
    echo "Thương: " . ($a / $b) . "<br>";
    echo "Số dư: " . ($a % $b) . "<br>";

    // Sử dụng toán tử nối chuỗi
    $thongBao = "Kết quả so sánh giữa chuỗi '5' và số 5: ";
    $thongBao .= "Rất thú vị!";
    echo "<h3>$thongBao</h3>";

    echo "'5' == 5 là: "; var_dump("5" == 5); // true: chỉ so sánh giá trị
    echo "<br>'5' === 5 là: "; var_dump("5" === 5); // false: so sánh cả kiểu dữ liệu (string vs int)
?>