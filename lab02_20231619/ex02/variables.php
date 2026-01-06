<?php
    $fullName = "Nguyễn Văn Dũng";
    $age = 20;
    $gpa = 3.8;
    $isActive = true;

    define("SCHOOL", "Trường Đại học Công Nghệ Đông Á"); 

    echo "<h3>Thông tin sinh viên:</h3>";
    echo "Họ tên: $fullName <br>";
    echo "Trường: " . SCHOOL . "<br>";

    // Thử nội suy chuỗi
    echo "Nháy kép: Tuổi của $fullName là $age <br>"; // PHP sẽ hiểu và in giá trị biến
    echo 'Nháy đơn: Tuổi của $fullName là $age <br>'; // PHP coi đây là chuỗi thuần túy, không hiện giá trị

    echo "<h3>Debug dữ liệu:</h3>";
    var_dump($fullName); echo "<br>";
    var_dump($age); echo "<br>";
    var_dump($gpa); echo "<br>";
    var_dump($isActive);
?>