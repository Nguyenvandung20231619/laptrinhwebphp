<?php
session_start();

// Kiểm tra quyền truy cập
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Xin chào, <strong><?php echo $_SESSION['user']; ?></strong>!</p>
    <p>MSSV của bạn: 20231619</p>
    <hr>
    <a href="logout.php"><button>Đăng xuất</button></a>
</body>
</html>