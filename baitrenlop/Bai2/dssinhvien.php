<?php
class Student {
    public $id, $name, $gpa, $rank;

    public function __construct($id, $name, $gpa) {
        $this->id = $id;
        $this->name = $name;
        $this->gpa = (float)$gpa; //Ép kiểu float
        $this->rank = $this->calculateRank();
    }

    private function calculateRank() {
        if ($this->gpa >= 3.6) return "Xuất sắc";
        if ($this->gpa >= 3.2) return "Giỏi";
        if ($this->gpa >= 2.5) return "Khá";
        return "Trung bình";
    }
}

$input = "SV001-An-3.2;SV002-Binh-2.6;SV003-Chi-3.5";

//Tách bản ghi
$records = explode(';', $input);
$list = [];

foreach ($records as $item) {
    //Tách thông tin chi tiết
    $parts = explode('-', $item);
    if (count($parts) == 3) {
        //Trim và tạo Object đưa vào mảng
        $list[] = new Student(trim($parts[0]), trim($parts[1]), trim($parts[2]));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kết quả thực hành</title>
    <style>
        table { border-collapse: collapse; width: 100%; max-width: 600px; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background: #eee; }
        .gioi { background-color: #e8f5e9; font-weight: bold; }
    </style>
</head>
<body>
    <h3>Danh sách sinh viên</h3>
    <table>
        <tr><th>Name</th><th>GPA</th><th>Rank</th></tr>
        <?php foreach ($list as $sv): ?>
        <tr>
            <td><?= htmlspecialchars($sv->name) ?></td>
            <td><?= $sv->gpa ?></td>
            <td><?= $sv->rank ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Sinh viên giỏi (GPA >= 3.2)</h3>
    <table>
        <tr><th>Name</th><th>GPA</th></tr>
        <?php foreach ($list as $sv): ?>
            <?php if ($sv->gpa >= 3.2): ?>
            <tr class="gioi">
                <td><?= htmlspecialchars($sv->name) ?></td>
                <td><?= $sv->gpa ?></td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>