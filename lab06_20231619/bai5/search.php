<?php
$kw = $_GET['kw'] ?? '';
$cat = $_GET['category'] ?? 'all';
$books = file_exists('../data/books.json') ? json_decode(file_get_contents('../data/books.json'), true) : [];

$results = array_filter($books, function($b) use ($kw, $cat) {
    $matchKw = empty($kw) || stripos($b['title'], $kw) !== false || stripos($b['author'], $kw) !== false;
    $matchCat = ($cat === 'all') || ($b['category'] === $cat);
    return $matchKw && $matchCat;
});
?>
<form method="GET">
    Từ khóa: <input type="text" name="kw" value="<?= htmlspecialchars($kw) ?>">
    Thể loại: 
    <select name="category">
        <option value="all">Tất cả</option>
        <option value="Giáo trình" <?= $cat=='Giáo trình'?'selected':'' ?>>Giáo trình</option>
        <option value="Kỹ năng" <?= $cat=='Kỹ năng'?'selected':'' ?>>Kỹ năng</option>
    </select>
    <button type="submit">Tìm kiếm</button>
</form>

<?php if ($results): ?>
    <table border="1">
        <?php foreach($results as $r): ?>
            <tr><td><?= htmlspecialchars($r['title']) ?></td><td><?= htmlspecialchars($r['category']) ?></td></tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Không tìm thấy kết quả.</p>
<?php endif; ?>