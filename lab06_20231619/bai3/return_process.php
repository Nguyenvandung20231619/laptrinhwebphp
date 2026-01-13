<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Truy cập không hợp lệ.");
}

$borrow_id = trim($_POST['borrow_id'] ?? '');
$borrows = json_decode(file_get_contents('../data/borrows.json'), true) ?? [];
$found = false;

foreach ($borrows as &$br) {
    if ($br['id'] === $borrow_id && $br['status'] === 'Đang mượn') {
        // 1. Cập nhật trạng thái phiếu
        $br['status'] = 'Đã trả';
        $book_id = $br['book_id'];
        
        // 2. Tăng số lượng sách trong books.json
        $books = json_decode(file_get_contents('../data/books.json'), true) ?? [];
        foreach ($books as &$b) {
            if ($b['id'] == $book_id) { $b['quantity']++; break; }
        }
        file_put_contents('../data/books.json', json_encode($books, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $found = true;
        $summary = $br;
        break;
    }
}

if ($found) {
    file_put_contents('../data/borrows.json', json_encode($borrows, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    echo "<h3>Trả sách thành công!</h3>";
    echo "Mã phiếu: " . htmlspecialchars($summary['id']) . "<br>";
    echo "Mã sách: " . htmlspecialchars($summary['book_id']) . " đã được hoàn kho.";
    echo "<br><a href='return_form.php'>Quay lại</a>";
} else {
    echo "Lỗi: Phiếu không tồn tại hoặc đã được trả trước đó. <a href='return_form.php'>Quay lại</a>";
}