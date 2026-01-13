<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Truy cập không hợp lệ. <a href='borrow_form.php'>Quay lại</a>");
}

$m_id = trim($_POST['member_id'] ?? '');
$b_id = trim($_POST['book_id'] ?? '');
$date = $_POST['borrow_date'] ?? '';
$days = intval($_POST['duration'] ?? 7);

// 1. Kiểm tra thành viên trong members.csv
$member_exists = false;
if (($f = fopen("../data/members.csv", "r")) !== FALSE) {
    while (($row = fgetcsv($f)) !== FALSE) {
        if ($row[2] == $m_id) { $member_exists = true; break; }
    }
    fclose($f);
}

// 2. Kiểm tra sách và số lượng trong books.json
$books = json_decode(file_get_contents('../data/books.json'), true) ?? [];
$book_idx = -1;
foreach ($books as $idx => $b) {
    if ($b['id'] == $b_id) { $book_idx = $idx; break; }
}

// 3. Thực hiện validate
if (!$member_exists) die("Lỗi: Mã thành viên (SĐT) không tồn tại. <a href='borrow_form.php'>Quay lại</a>");
if ($book_idx === -1) die("Lỗi: Mã sách không tồn tại. <a href='borrow_form.php'>Quay lại</a>");
if ($books[$book_idx]['quantity'] <= 0) die("Lỗi: Sách này đã hết trong kho. <a href='borrow_form.php'>Quay lại</a>");

// 4. Cập nhật: Trừ sách và Ghi phiếu mượn
$books[$book_idx]['quantity']--;
file_put_contents('../data/books.json', json_encode($books, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

$borrows = file_exists('../data/borrows.json') ? json_decode(file_get_contents('../data/borrows.json'), true) : [];
$due_date = date('Y-m-d', strtotime($date . " + $days days"));
$new_borrow = [
    'id' => 'PM' . time(),
    'member_id' => $m_id,
    'book_id' => $b_id,
    'borrow_date' => $date,
    'due_date' => $due_date,
    'status' => 'Đang mượn'
];
$borrows[] = $new_borrow;
file_put_contents('../data/borrows.json', json_encode($borrows, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

echo "<h3>Cho mượn thành công!</h3>";
echo "Mã phiếu: " . $new_borrow['id'] . "<br>Hạn trả: " . $due_date;
echo "<br><a href='borrow_form.php'>Tiếp tục mượn</a>";