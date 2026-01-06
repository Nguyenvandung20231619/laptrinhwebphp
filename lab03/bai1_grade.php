<?php
$score = isset($_GET["score"]) ? (float)$_GET["score"] : null;

if ($score === null) {
    echo "Hãy truyền ?score=... trên URL (Ví dụ: ?score=8.5)";
    exit;
}

echo "<h3>Kết quả phân loại điểm</h3>";
if ($score < 0 || $score > 10) {
    echo "Lỗi: Điểm $score không hợp lệ (phải từ 0 đến 10).";
} else {
    $rank = "";
    if ($score >= 8.5) $rank = "Giỏi";
    elseif ($score >= 7.0) $rank = "Khá";
    elseif ($score >= 5.0) $rank = "Trung bình";
    else $rank = "Yếu";

    echo "Điểm: $score – Xếp loại: $rank";
}
?>