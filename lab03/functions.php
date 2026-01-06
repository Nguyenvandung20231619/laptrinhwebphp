<?php
// 1. Hàm tìm số lớn nhất và nhỏ nhất giữa 2 số
function max2($a, $b) {
    return ($a > $b) ? $a : $b;
}

function min2($a, $b) {
    return ($a < $b) ? $a : $b;
}

// 2. Kiểm tra số nguyên tố
function isPrime(int $n): bool {
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

// 3. Tính giai thừa (n!)
function factorial(int $n) {
    if ($n < 0) return null;
    if ($n == 0) return 1;
    $res = 1;
    for ($i = 1; $i <= $n; $i++) {
        $res *= $i;
    }
    return $res;
}

// 4. Tìm ước số chung lớn nhất (GCD) - Thuật toán Euclid
function gcd(int $a, int $b): int {
    $a = abs($a);
    $b = abs($b);
    while ($b != 0) {
        $tmp = $a % $b;
        $a = $b;
        $b = $tmp;
    }
    return $a;
}
?>