<!DOCTYPE html>
<html>
<head>
    <title>Quản lý sinh viên - <?php echo "20231619"; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Danh sách sinh viên</h2>
    <form id="studentForm">
        <input type="hidden" name="id" id="student_id">
        <input type="text" name="code" id="code" placeholder="Mã SV" required>
        <input type="text" name="full_name" id="full_name" placeholder="Họ tên" required>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="date" name="dob" id="dob">
        <button type="submit" id="btnSave">Lưu</button>
        <button type="button" id="btnReset" onclick="resetForm()">Hủy</button>
    </form>

    <table border="1" style="margin-top:20px; width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Ngày sinh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody id="studentTableBody"></tbody>
    </table>

    <script src="assets/js/app.js"></script>
</body>
</html>