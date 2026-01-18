<?php
require_once __DIR__ . '/../models/StudentModel.php';

class StudentController {
    private $model;

    public function __construct() {
        $this->model = new StudentModel();
    }

    public function index() {
        // Render trang chính
        require_once __DIR__ . '/../views/students/index.php';
    }

    public function api() {
        header('Content-Type: application/json');
        $action = $_GET['action'] ?? '';
        $res = ['success' => false, 'message' => 'Hành động không hợp lệ'];

        try {
            switch ($action) {
                case 'list':
                    $res = ['success' => true, 'data' => $this->model->all()];
                    break;

                case 'get':
                    $res = ['success' => true, 'data' => $this->model->find($_GET['id'])];
                    break;

                case 'save':
                    $id = $_POST['id'] ?? null;
                    $data = [
                        'code' => trim($_POST['code']),
                        'full_name' => trim($_POST['full_name']),
                        'email' => trim($_POST['email']),
                        'dob' => $_POST['dob'] ?: null
                    ];

                    // Validate đơn giản
                    if (empty($data['code']) || empty($data['full_name']) || empty($data['email'])) {
                        throw new Exception("Vui lòng điền đầy đủ các trường bắt buộc");
                    }

                    // Check trùng mã/email
                    if ($this->model->checkDuplicate('code', $data['code'], $id)) throw new Exception("Mã SV đã tồn tại");
                    if ($this->model->checkDuplicate('email', $data['email'], $id)) throw new Exception("Email đã tồn tại");

                    if ($id) {
                        $this->model->update($id, $data);
                        $res = ['success' => true, 'message' => 'Cập nhật thành công'];
                    } else {
                        $this->model->create($data);
                        $res = ['success' => true, 'message' => 'Thêm mới thành công'];
                    }
                    break;

                case 'delete':
                    if ($this->model->delete($_POST['id'])) {
                        $res = ['success' => true, 'message' => 'Xóa sinh viên thành công'];
                    }
                    break;
            }
        } catch (Exception $e) {
            $res = ['success' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($res);
    }
}