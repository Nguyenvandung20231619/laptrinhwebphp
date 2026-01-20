<h2>Chỉnh sửa Sách</h2>
<form action="index.php?c=books&a=update" method="POST">
    <input type="hidden" name="id" value="<?= (int)$book['id'] ?>">
    <p>Tiêu đề: <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required></p>
    <p>Tác giả: <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required></p>
    <p>Giá: <input type="number" name="price" step="0.01" value="<?= $book['price'] ?>" required></p>
    <p>Số lượng kho: <input type="number" name="qty" value="<?= $book['qty'] ?>" required></p>
    <button type="submit">Cập nhật</button>
    <a href="index.php?c=books&a=index">Hủy</a>
</form>