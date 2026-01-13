
<?php
// Sử lý lưu JSON
if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit('Truy cập trực tiếp bị chặn.');

$id = trim($_POST['id'] ?? '');
$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$year = intval($_POST['year'] ?? 0);
$category = $_POST['category'] ?? '';
$quantity = intval($_POST['quantity'] ?? 0);

$errors = [];
$jsonFile = '../data/books.json';
$books = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

// Validate 
foreach($books as $b) {
    if ($b['id'] === $id) { $errors[] = "Mã sách đã tồn tại!"; break; }
}
if ($year < 1900 || $year > date('Y')) $errors[] = "Năm xuất bản không hợp lệ.";

if ($errors) {
    header("Location: add_book.php?errors=".base64_encode(json_encode($errors))."&old=".base64_encode(json_encode($_POST)));
    exit;
}

$books[] = ['id' => $id, 'title' => $title, 'author' => $author, 'year' => $year, 'category' => $category, 'quantity' => $quantity];
file_put_contents($jsonFile, json_encode($books, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
header("Location: list_books.php");