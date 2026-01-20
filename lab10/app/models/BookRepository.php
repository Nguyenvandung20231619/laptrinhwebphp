<?php
class BookRepository {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function getAll($search = '', $sort = 'created_at', $dir = 'DESC') {
        $allowed = ['title', 'author', 'price', 'qty', 'created_at'];
        $sort = in_array($sort, $allowed) ? $sort : 'created_at';
        $dir = strtoupper($dir) === 'ASC' ? 'ASC' : 'DESC';

        // SỬA LỖI: Dùng tên tham số khác nhau hoặc truyền mảng đủ giá trị
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE title LIKE :kw1 OR author LIKE :kw2 ORDER BY $sort $dir");
        $stmt->execute(['kw1' => "%$search%", 'kw2' => "%$search%"]); 
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([(int)$id]);
        return $stmt->fetch();
    }

    public function store($data) {
        $stmt = $this->pdo->prepare("INSERT INTO books (title, author, price, qty) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['title'], $data['author'], $data['price'], (int)$data['qty']]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE books SET title=?, author=?, price=?, qty=? WHERE id=?");
        return $stmt->execute([$data['title'], $data['author'], $data['price'], (int)$data['qty'], (int)$id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([(int)$id]);
    }
}