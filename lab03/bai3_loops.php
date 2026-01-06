<?php
$n = isset($_GET["n"]) ? (int)$_GET["n"] : 0;
echo "<h3>Vòng lặp</h3>";

// A) Bảng cửu chương 1..9
echo "<h4>A. Bảng cửu chương</h4><table border='1' cellpadding='5' style='border-collapse:collapse;'><tr>";
for ($i = 1; $i <= 9; $i++) {
    echo "<td>";
    for ($j = 1; $j <= 10; $j++) {
        echo "$i x $j = " . ($i * $j) . "<br>";
    }
    echo "</td>";
}
echo "</tr></table>";

// B) Tổng chữ số của n
$tempN = abs($n);
$sum = 0;
while ($tempN > 0) {
    $sum += $tempN % 10;
    $tempN = (int)($tempN / 10);
}
echo "<h4>B. Tổng chữ số của n = $n là: $sum</h4>";

// C) Số lẻ từ 1..N (Dùng continue và break)
echo "<h4>C. Các số lẻ (Dừng nếu > 15):</h4>";
for ($i = 1; $i <= $n; $i++) {
    if ($i % 2 == 0) continue;
    if ($i > 15) break;
    echo "$i ";
}
?>