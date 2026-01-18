<?php
require_once __DIR__ . '/../core/Database.php';

class StudentModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM students ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO students (code, full_name, email, dob) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['code'], $data['full_name'], $data['email'], $data['dob']]);
    }

    public function update($id, $data) {
        $sql = "UPDATE students SET code = ?, full_name = ?, email = ?, dob = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['code'], $data['full_name'], $data['email'], $data['dob'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function checkDuplicate($column, $value, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM students WHERE $column = ?";
        $params = [$value];
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }
}