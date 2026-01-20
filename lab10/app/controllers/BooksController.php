<?php
class BooksController {
    private $repo;
    public function __construct() { global $pdo; $this->repo = new BookRepository($pdo); }

    public function index() {
        $books = $this->repo->getAll($_GET['search'] ?? '', $_GET['sort'] ?? 'created_at');
        require_once '../app/views/books/index.php';
    }

    public function create() { require_once '../app/views/books/create.php'; }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repo->store($_POST);
            header("Location: index.php?c=books&a=index");
            exit;
        }
    }

    public function edit() {
        $book = $this->repo->find($_GET['id'] ?? 0);
        require_once '../app/views/books/edit.php';
    }

    public function update() {
        $this->repo->update($_POST['id'], $_POST);
        header("Location: index.php?c=books&a=index");
        exit;
    }

    public function delete() {
        $this->repo->delete($_POST['id']);
        header("Location: index.php?c=books&a=index");
        exit;
    }
}