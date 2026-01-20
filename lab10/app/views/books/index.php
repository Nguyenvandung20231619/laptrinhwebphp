<h2>Quản lý Sách</h2>
<form method="GET" action="index.php">
    <input type="hidden" name="c" value="books"> <input type="hidden" name="a" value="index">
    <input type="text" name="search" placeholder="Tìm kiếm..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <button type="submit">Tìm</button>
</form>

<p><a href="index.php?c=books&a=create"><b>+ Thêm sách mới</b></a></p>

<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <tr style="background: #f2f2f2;">
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Tác giả</th>
        <th>Tồn kho</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach ($books as $b): ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= htmlspecialchars($b['title']) ?></td>
        <td><?= htmlspecialchars($b['author']) ?></td>
        <td><?= $b['qty'] ?></td>
        <td>
            <a href="index.php?c=books&a=edit&id=<?= $b['id'] ?>">Sửa</a> | 
            <form action="index.php?c=books&a=delete" method="POST" style="display:inline;" onsubmit="return confirm('Xóa sách này?')">
                <input type="hidden" name="id" value="<?= $b['id'] ?>">
                <button type="submit" style="color:red; border:none; background:none; cursor:pointer; text-decoration:underline;">Xóa</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>