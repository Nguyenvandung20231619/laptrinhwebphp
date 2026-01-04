<?php
// Hàm tìm số lớn nhất
function max2($a, $b) {
    return ($a > $b) ? $a : $b;
}

// Hàm tìm số nhỏ nhất
function min2($a, $b) {
    return ($a < $b) ? $a : $b;
}

// Hàm kiểm tra số nguyên tố
function isPrime($n) {
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

// Hàm tính giai thừa (n!)
function factorial($n) {
    if ($n < 0) return "Lỗi: n phải >= 0";
    if ($n == 0 || $n == 1) return 1;
    return $n * factorial($n - 1);
}

// Hàm tìm Ước chung lớn nhất (Euclid)
function gcd($a, $b) {
    $a = abs($a);
    $b = abs($b);
    while ($b != 0) {
        $temp = $a % $b;
        $a = $b;
        $b = $temp;
    }
    return $a;
}
?>