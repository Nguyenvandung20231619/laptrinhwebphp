<h2>Chi tiết phiếu mượn #<?= (int)$_GET['id'] ?></h2>
<p><a href="index.php?c=borrows&a=index">← Quay lại danh sách</a></p>

<table border="1" cellpadding="10">
    <tr>
        <th>Tên sách</th>
        <th>Số lượng mượn</th>
    </tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?= htmlspecialchars($item['title']) ?></td>
        <td><?= $item['qty'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>