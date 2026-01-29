<?php
// Nạp helper để sử dụng chức năng Flash Message
require_once '../helpers/session_helper.php';
require_once '../config/database.php';
require_once '../models/Product.php';

$db = (new Database())->getConnection();
$productModel = new Product($db);

// Cấu hình phân trang (Topic 1)
$limit = 5;
$total_records = $productModel->countAll();
$total_pages = ceil($total_records / $limit);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $total_pages && $total_pages > 0) $page = $total_pages;

$offset = ($page - 1) * $limit;
$products = $productModel->getPage($limit, $offset);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f7f6; }
        .container { max-width: 1100px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header-actions { display: flex; justify-content: space-between; margin-bottom: 20px; align-items: center; }
        input[type="text"] { padding: 10px; width: 300px; border: 1px solid #ddd; border-radius: 4px; }
        
        /* Flash Message Styling */
        .flash-alert { background-color: #d4edda; color: #155724; padding: 12px; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 20px; }
        
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; color: #333; }
        .img-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; }
        
        button { padding: 8px 15px; cursor: pointer; border-radius: 4px; border: none; font-weight: bold; }
        .btn-add { background-color: #28a745; color: white; }
        .btn-edit { background-color: #ffc107; color: #333; margin-right: 5px; }
        .btn-delete { background-color: #dc3545; color: white; }

        .pagination { margin-top: 20px; display: flex; gap: 5px; justify-content: center; }
        .pagination a { padding: 8px 16px; border: 1px solid #ddd; text-decoration: none; color: #007bff; border-radius: 4px; }
        .pagination a.active { background-color: #007bff; color: white; border-color: #007bff; }

        /* Modal */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
        .modal-content { background: white; margin: 5% auto; padding: 25px; border-radius: 8px; width: 450px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Hệ thống Quản lý Sản phẩm</h2>

    <?php if ($msg = get_flash()): ?>
        <div class="flash-alert" id="flash-msg">
            <?= $msg ?>
        </div>
        <script>
            setTimeout(function() { $('#flash-msg').fadeOut('slow'); }, 3000);
        </script>
    <?php endif; ?>

    <div class="header-actions">
        <input type="text" id="search-input" placeholder="Tìm kiếm theo tên hoặc mã...">
        <button class="btn-add" onclick="openModal('add')">+ Thêm sản phẩm</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Mã SP</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            <?php foreach ($products as $p): ?>
            <tr id="row-<?= $p['id'] ?>">
                <td><?= $p['id'] ?></td>
                <td>
                    <img src="../public/uploads/<?= !empty($p['image']) ? $p['image'] : 'default.png' ?>" class="img-thumb" alt="sp">
                </td>
                <td><b><?= $p['code'] ?></b></td>
                <td><?= $p['name'] ?></td>
                <td><?= number_format($p['price'], 0, ',', '.') ?> đ</td>
                <td>
                    <button class="btn-edit" onclick='openEditModal(<?= json_encode($p) ?>)'>Sửa</button>
                    <button class="btn-delete" onclick="deleteProduct(<?= $p['id'] ?>)">Xóa</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination" id="pagination-nav">
        <a href="?page=1">Đầu</a>
        <?php for($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
        <a href="?page=<?= $total_pages ?>">Cuối</a>
    </div>
</div>

<div id="productModal" class="modal">
    <div class="modal-content">
        <h3 id="modal-title">Sản phẩm</h3>
        <form id="product-form" enctype="multipart/form-data">
            <input type="hidden" id="prod-id" name="id">
            <div class="form-group">
                <label>Mã sản phẩm:</label>
                <input type="text" id="prod-code" name="code" required>
            </div>
            <div class="form-group">
                <label>Tên sản phẩm:</label>
                <input type="text" id="prod-name" name="name" required>
            </div>
            <div class="form-group">
                <label>Giá bán (VNĐ):</label>
                <input type="number" id="prod-price" name="price" required>
            </div>
            <div class="form-group">
                <label>Ảnh sản phẩm :</label>
                <input type="file" name="image" id="prod-image" accept="image/*">
            </div>
            <div style="text-align: right; margin-top: 20px;">
                <button type="button" onclick="closeModal()" style="background:#6c757d; color:white;">Hủy</button>
                <button type="submit" class="btn-add">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // 1. LIVE SEARCH (Gõ phím tới đâu lọc tới đó)
    $('#search-input').on('keyup', function() {
        const query = $(this).val();
        if (query.length > 0) {
            $('#pagination-nav').hide(); // Ẩn phân trang khi tìm kiếm
            $.ajax({
                url: '../api/search.php',
                type: 'GET',
                data: { q: query },
                success: function(response) {
                    if (response.success) renderTable(response.data);
                }
            });
        } else {
            window.location.reload(); // Reset về trang ban đầu nếu xóa ô tìm kiếm
        }
    });

    // 2. XỬ LÝ LƯU (THÊM/SỬA) QUA AJAX - DÙNG FORMDATA ĐỂ UPLOAD ẢNH
    $('#product-form').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this); // Bắt buộc dùng FormData để gửi file ảnh

        $.ajax({
            url: '../api/save.php',
            type: 'POST',
            data: formData,
            processData: false, // Bắt buộc khi dùng FormData
            contentType: false, // Bắt buộc khi dùng FormData
            success: function(response) {
                if (response.success) {
                    // Reload để hiển thị Flash Message từ Session PHP
                    window.location.reload(); 
                } else {
                    alert("Lỗi: " + response.message);
                }
            },
            error: function() {
                alert("Không thể kết nối với máy chủ.");
            }
        });
    });
});

// Hàm render bảng dữ liệu khi Search
function renderTable(data) {
    let rows = '';
    if (data.length === 0) {
        rows = '<tr><td colspan="6" style="text-align:center;">Không tìm thấy sản phẩm.</td></tr>';
    } else {
        data.forEach(p => {
            rows += `
                <tr>
                    <td>${p.id}</td>
                    <td><img src="../public/uploads/${p.image || 'default.png'}" class="img-thumb" alt="sp"></td>
                    <td><b>${p.code}</b></td>
                    <td>${p.name}</td>
                    <td>${new Intl.NumberFormat('vi-VN').format(p.price)} đ</td>
                    <td>
                        <button class="btn-edit" onclick='openEditModal(${JSON.stringify(p)})'>Sửa</button>
                        <button class="btn-delete" onclick="deleteProduct(${p.id})">Xóa</button>
                    </td>
                </tr>`;
        });
    }
    $('#product-table-body').html(rows);
}

// Hàm xóa sản phẩm
function deleteProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
        $.post('../api/delete.php', { id: id }, function(response) {
            if (response.success) {
                window.location.reload();
            } else {
                alert(response.message);
            }
        });
    }
}

// Điều khiển Modal
function openModal(type) {
    $('#product-form')[0].reset();
    $('#prod-id').val('');
    $('#modal-title').text(type === 'add' ? 'Thêm sản phẩm mới' : 'Cập nhật sản phẩm');
    $('#productModal').fadeIn();
}

function openEditModal(product) {
    openModal('edit');
    $('#prod-id').val(product.id);
    $('#prod-code').val(product.code);
    $('#prod-name').val(product.name);
    $('#prod-price').val(product.price);
}

function closeModal() {
    $('#productModal').fadeOut();
}
</script>

</body>
</html>