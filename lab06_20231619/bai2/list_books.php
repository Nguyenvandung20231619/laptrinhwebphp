<?php
$books = file_exists('../data/books.json') ? json_decode(file_get_contents('../data/books.json'), true) : [];
?>
<h2>Danh sách sách trong kho</h2>
<table border="1" cellpadding="5">
    <tr><th>Mã</th><th>Tên</th><th>Tác giả</th><th>Năm</th><th>Thể loại</th><th>SL</th></tr>
    <?php foreach($books as $b): ?>
    <tr>
        <td><?= htmlspecialchars($b['id']) ?></td>
        <td><?= htmlspecialchars($b['title']) ?></td>
        <td><?= htmlspecialchars($b['author']) ?></td>
        <td><?= htmlspecialchars($b['year']) ?></td>
        <td><?= htmlspecialchars($b['category']) ?></td>
        <td><?= htmlspecialchars($b['quantity']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<br><a href="add_book.php">Thêm sách mới</a>