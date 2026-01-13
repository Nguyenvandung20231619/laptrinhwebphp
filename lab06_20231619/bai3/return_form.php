<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trả sách - 20231619</title>
</head>
<body>
    <h2>TRẢ SÁCH</h2>
    <form action="return_process.php" method="POST">
        Mã phiếu mượn: <input type="text" name="borrow_id" required placeholder="Ví dụ: PM17000000"><br><br>
        Ngày trả thực tế: <input type="date" name="return_date" value="<?= date('Y-m-d') ?>" required><br><br>
        <button type="submit">Xác nhận trả sách</button>
    </form>
    <br><a href="borrow_form.php">Quay lại trang Mượn sách</a>
</body>
</html>