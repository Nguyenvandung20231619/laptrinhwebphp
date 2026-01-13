<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

$items = $_POST['items'];
$validItems = [];
$subtotal = 0;

foreach($items as $it) {
    if (!empty($it['name']) && $it['qty'] > 0 && $it['price'] > 0) {
        $amount = $it['qty'] * $it['price'];
        $it['amount'] = $amount;
        $subtotal += $amount;
        $validItems[] = $it;
    }
}

if (empty($validItems)) exit("Phải có ít nhất 1 mặt hàng hợp lệ.");

$discountVal = $subtotal * ($_POST['discount'] / 100);
$vatVal = ($subtotal - $discountVal) * ($_POST['vat'] / 100);
$total = $subtotal - $discountVal + $vatVal;

// Lưu file
$invoice = ['phone' => $_POST['phone'], 'items' => $validItems, 'total' => $total, 'date' => date('Y-m-d H:i:s')];
file_put_contents("../data/invoices/invoice_".time().".json", json_encode($invoice));
?>
<h3>CHI TIẾT HÓA ĐƠN</h3>
<table border="1">
    <tr><th>Tên hàng</th><th>SL</th><th>Đơn giá</th><th>Thành tiền</th></tr>
    <?php foreach($validItems as $v): ?>
        <tr>
            <td><?= htmlspecialchars($v['name']) ?></td>
            <td><?= $v['qty'] ?></td>
            <td><?= number_format($v['price']) ?></td>
            <td><?= number_format($v['amount']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<p>Tạm tính: <?= number_format($subtotal) ?>đ</p>
<p>Tổng thanh toán: <strong><?= number_format($total) ?>đ</strong></p>