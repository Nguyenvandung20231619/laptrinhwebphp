<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lập phiếu mượn - 20231619</title>
</head>
<body>
    <h2>LẬP PHIẾU MƯỢN SÁCH</h2>
    <form action="borrow_process.php" method="POST">
        Mã thành viên (SĐT): <input type="text" name="member_id" placeholder="Nhập SĐT đã đăng ký" required><br><br>
        Mã sách: <input type="text" name="book_id" placeholder="Nhập mã ISBN/nội bộ" required><br><br>
        Ngày mượn: <input type="date" name="borrow_date" value="<?= date('Y-m-d') ?>" required><br><br>
        Số ngày mượn: <input type="number" name="duration" min="1" max="30" value="7"> (Tối đa 30 ngày)<br><br>
        <button type="submit">Xác nhận mượn</button>
    </form>
    <br><a href="return_form.php">Chuyển sang trang Trả sách</a>
</body>
</html>