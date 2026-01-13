<?php
// Giao diện nhập sách
$errors = isset($_GET['errors']) ? json_decode(base64_decode($_GET['errors']), true) : [];
$old = isset($_GET['old']) ? json_decode(base64_decode($_GET['old']), true) : [];
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Thêm sách mới</title></head>
<body>
    <h2>Thêm sách vào kho</h2>
    <?php if ($errors): ?>
        <ul style="color:red;"><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul>
    <?php endif; ?>
    <form action="add_book_process.php" method="POST">
        Mã sách: <input type="text" name="id" value="<?= htmlspecialchars($old['id'] ?? '') ?>" required><br>
        Tên sách: <input type="text" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>" required><br>
        Tác giả: <input type="text" name="author" value="<?= htmlspecialchars($old['author'] ?? '') ?>" required><br>
        Năm XB: <input type="number" name="year" min="1900" max="<?= date('Y') ?>" value="<?= htmlspecialchars($old['year'] ?? date('Y')) ?>"><br>
        Thể loại: 
        <select name="category">
            <?php $cats = ['Giáo trình', 'Kỹ năng', 'Văn học', 'Khoa học', 'Khác']; 
            foreach($cats as $cat): ?>
                <option value="<?= $cat ?>" <?= (isset($old['category']) && $old['category'] == $cat) ? 'selected' : '' ?>><?= $cat ?></option>
            <?php endforeach; ?>
        </select><br>
        Số lượng: <input type="number" name="quantity" min="0" value="<?= htmlspecialchars($old['quantity'] ?? 1) ?>"><br>
        <button type="submit">Thêm sách</button>
    </form>
    <br><a href="list_books.php">Xem danh sách sách</a>
</body>
</html>