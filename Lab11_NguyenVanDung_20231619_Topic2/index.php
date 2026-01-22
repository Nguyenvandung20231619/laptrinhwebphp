<?php
require 'config.php';

$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM employees WHERE full_name LIKE ? OR email LIKE ? ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$search%", "%$search%"]);
$employees = $stmt->fetchAll();
?>

<h2>Quản lý Nhân viên</h2>
<form method="GET" style="margin-bottom: 15px;">
    <input type="text" name="search" placeholder="Tìm theo tên hoặc email..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Tìm kiếm</button>
    <a href="index.php">Reset</a>
</form>

<a href="create.php"><button>+ Thêm nhân viên mới</button></a>
<?php display_flash(); ?>

<table border="1" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Chức vụ</th>
        <th>Lương</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($employees as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['full_name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['position']) ?></td>
        <td><?= number_format($row['salary']) ?></td>
        <td><?= $row['status'] == 1 ? 'Đang làm' : 'Nghỉ việc' ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Sửa</a> | 
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>