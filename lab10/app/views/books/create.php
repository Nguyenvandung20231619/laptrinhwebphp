<h2>Thêm Sách Mới</h2>
<form action="index.php?c=books&a=store" method="POST">
    <p>Tiêu đề: <input type="text" name="title" required></p>
    <p>Tác giả: <input type="text" name="author" required></p>
    <p>Giá: <input type="number" name="price" step="0.01" required></p>
    <p>Số lượng kho: <input type="number" name="qty" required></p>
    <button type="submit">Lưu lại</button>
    <a href="index.php?c=books&a=index">Hủy</a>
</form>