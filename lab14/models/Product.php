<?php
class Product {
    private $conn;
    private $table = "products";

    public function __construct($db) { $this->conn = $db; }

    // Topic 1: Đếm tổng số bản ghi để tính số trang
    public function countAll() {
        $sql = "SELECT COUNT(*) as total FROM " . $this->table;
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Topic 1: Lấy dữ liệu theo phân trang
    public function getPage($limit, $offset) {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Topic 2: Thêm mới có ảnh
    public function create($code, $name, $price, $image) {
        $query = "INSERT INTO $this->table (code, name, price, image) VALUES (?, ?, ?, ?)";
        return $this->conn->prepare($query)->execute([$code, $name, $price, $image]);
    }

    // Topic 2: Cập nhật có xử lý ảnh
    public function update($id, $code, $name, $price, $image = null) {
        if ($image) {
            $query = "UPDATE $this->table SET code=?, name=?, price=?, image=? WHERE id=?";
            return $this->conn->prepare($query)->execute([$code, $name, $price, $image, $id]);
        }
        $query = "UPDATE $this->table SET code=?, name=?, price=? WHERE id=?";
        return $this->conn->prepare($query)->execute([$code, $name, $price, $id]);
    }

    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = ?";
        return $this->conn->prepare($query)->execute([$id]);
    }

    public function getOne($id) {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search($keyword) {
        $query = "SELECT * FROM $this->table WHERE name LIKE ? OR code LIKE ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(["%$keyword%", "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}