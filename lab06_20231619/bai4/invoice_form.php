<h2>Tạo hóa đơn</h2>
<form action="invoice_process.php" method="POST">
    SĐT khách hàng (*): <input type="text" name="phone" required><br>
    <hr>
    <?php for($i=1; $i<=3; $i++): ?>
        Hàng <?= $i ?>: <input type="text" name="items[<?= $i ?>][name]"> 
        SL: <input type="number" name="items[<?= $i ?>][qty]" value="0">
        Giá: <input type="number" name="items[<?= $i ?>][price]" value="0"><br>
    <?php endfor; ?>
    <hr>
    Giảm giá (%): <input type="number" name="discount" min="0" max="30" value="0">
    VAT (%): <input type="number" name="vat" min="0" max="15" value="10"><br>
    Thanh toán: 
    <input type="radio" name="pay" value="Tiền mặt" checked> Tiền mặt
    <input type="radio" name="pay" value="Chuyển khoản"> Chuyển khoản<br>
    <button type="submit">Xuất hóa đơn</button>
</form>