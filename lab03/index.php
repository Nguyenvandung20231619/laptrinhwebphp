<?php
require_once "functions.php";

$action = $_GET["action"] ?? "home";
$a = isset($_GET["a"]) ? (int)$_GET["a"] : 0;
$b = isset($_GET["b"]) ? (int)$_GET["b"] : 0;
$n = isset($_GET["n"]) ? (int)$_GET["n"] : 0;

echo "<h2>LAB03 - Mini Utility</h2>";
echo "<p>
    <a href='?action=max&a=10&b=22'>Max</a> |
    <a href='?action=min&a=10&b=22'>Min</a> |
    <a href='?action=prime&n=17'>Prime</a> |
    <a href='?action=fact&n=6'>Factorial</a> |
    <a href='?action=gcd&a=12&b=18'>GCD</a>
</p>";

echo "<hr><strong>Kết quả:</strong><br>";

switch ($action) {
    case "max":
        echo "Max của $a và $b là: " . max2($a, $b);
        break;
    case "min":
        echo "Min của $a và $b là: " . min2($a, $b);
        break;
    case "prime":
        echo "Số $n " . (isPrime($n) ? "là" : "không là") . " số nguyên tố.";
        break;
    case "fact":
        echo "Giai thừa của $n! = " . factorial($n);
        break;
    case "gcd":
        echo "ƯCLN của $a và $b là: " . gcd($a, $b);
        break;
    default:
        echo "Hãy chọn một chức năng phía trên.";
}
?>