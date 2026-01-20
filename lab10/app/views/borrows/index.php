<h2>Lịch sử mượn sách</h2>
<p><a href="index.php?c=borrows&a=create"><b>+ Lập phiếu mượn mới</b></a></p>

<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <tr style="background: #e3f2fd;">
        <th>Mã phiếu</th>
        <th>Người mượn</th>
        <th>Ngày mượn</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach ($borrows as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['full_name']) ?></td>
        <td><?= $row['borrow_date'] ?></td>
        <td>
            <a href="index.php?c=borrows&a=show&id=<?= $row['id'] ?>">Xem chi tiết</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>