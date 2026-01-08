<?php
session_start();
// Nếu đã login rồi thì vào thẳng dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập hệ thống</h2>
    <?php 
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>Email hoặc mật khẩu không đúng!</p>";
    }
    ?>
    <form action="process_login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Mật khẩu" required><br><br>
        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>