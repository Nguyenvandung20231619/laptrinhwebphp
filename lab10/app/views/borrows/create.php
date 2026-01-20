<h2>Lập Phiếu Mượn</h2>
<?php if(isset($_GET['error'])): ?>
    <div style="background: #ffcdd2; padding: 10px; margin-bottom: 10px; color: #b71c1c;">
        Lỗi: <?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

<form action="index.php?c=borrows&a=store" method="POST">
    <p>
        Chọn người mượn:
        <select name="borrower_id" required>
            <?php foreach ($borrowers as $br): ?>
                <option value="<?= $br['id'] ?>"><?= htmlspecialchars($br['full_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </p>

    <h3>Chọn sách mượn:</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Chọn</th>
            <th>Tên sách</th>
            <th>Tồn kho</th>
            <th>Số lượng mượn</th>
        </tr>
        <?php foreach ($books as $bk): ?>
        <tr>
            <td><input type="checkbox" name="book_ids[]" value="<?= $bk['id'] ?>"></td>
            <td><?= htmlspecialchars($bk['title']) ?></td>
            <td><?= $bk['qty'] ?></td>
            <td>
                <input type="number" name="qtys[<?= $bk['id'] ?>]" value="1" min="1" max="<?= $bk['qty'] ?>">
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <p>Ghi chú: <br><textarea name="note" rows="3" cols="40"></textarea></p>
    <hr>
    <button type="submit" style="padding: 10px 20px;">Xác nhận mượn sách</button>
    <a href="index.php?c=borrows&a=index">Hủy bỏ</a>
</form>