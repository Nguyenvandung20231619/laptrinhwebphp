<?php
// 1. Nạp file Database core
require_once __DIR__ . '/../app/core/Database.php';

header('Content-Type: text/html; charset=utf-8');

echo "<h2>Kiểm tra kết nối CSDL (PDO)</h2>";

try {
    // 2. Lấy kết nối từ Singleton
    $db = Database::getConnection();
    
    echo "<p style='color: green;'>✅ Kết nối tới CSDL 'it3220_php' thành công!</p>";

    // 3. Chạy lệnh SELECT COUNT(*) theo yêu cầu Bước 4
    $stmt = $db->query("SELECT COUNT(*) as total FROM students");
    $result = $stmt->fetch();

    echo "<ul>";
    echo "<li><strong>Trạng thái:</strong> Đang hoạt động</li>";
    echo "<li><strong>Số lượng sinh viên hiện có:</strong> " . $result['total'] . "</li>";
    echo "<li><strong>Thời gian hệ thống:</strong> " . date('Y-m-d H:i:s') . "</li>";
    echo "</ul>";

    // 4. Hiển thị thử 1 vài dòng dữ liệu mẫu (nếu có)
    if ($result['total'] > 0) {
        echo "<h4>Danh sách sơ bộ:</h4>";
        $list = $db->query("SELECT code, full_name FROM students LIMIT 3")->fetchAll();
        foreach ($list as $sv) {
            echo "- " . $sv['code'] . " | " . $sv['full_name'] . "<br>";
        }
    }

} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Kết nối thất bại!</p>";
    echo "<strong>Lỗi chi tiết:</strong> " . $e->getMessage();
    
    echo "<br><br><table border='1' cellpadding='5'>
            <tr><td>Host</td><td>localhost</td></tr>
            <tr><td>DB Name</td><td>it3220_php</td></tr>
            <tr><td>User</td><td>root</td></tr>
            <tr><td>Pass</td><td>(Trống)</td></tr>
          </table>";
} catch (Exception $e) {
    echo "<p style='color: orange;'>⚠️ Lỗi hệ thống: " . $e->getMessage() . "</p>";
}