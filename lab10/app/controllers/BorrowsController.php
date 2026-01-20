<?php
class BorrowsController {
    private $borrowRepo;
    private $bookRepo;

    public function __construct() {
        global $pdo;
        $this->borrowRepo = new BorrowRepository($pdo);
        $this->bookRepo = new BookRepository($pdo);
    }

    public function index() {
        $borrows = $this->borrowRepo->getAll();
        require_once '../app/views/borrows/index.php';
    }

    public function create() {
        global $pdo;
        $borrowers = $pdo->query("SELECT * FROM borrowers")->fetchAll();
        $books = $this->bookRepo->getAll();
        require_once '../app/views/borrows/create.php';
    }

    public function store() {
        $items = [];
        foreach (($_POST['book_ids'] ?? []) as $bid) {
            if ($_POST['qtys'][$bid] > 0) $items[$bid] = $_POST['qtys'][$bid];
        }
        try {
            $this->borrowRepo->storeBorrow($_POST['borrower_id'], $items, $_POST['note']);
            header("Location: index.php?c=borrows&a=index");
        } catch (Exception $e) {
            header("Location: index.php?c=borrows&a=create&error=" . urlencode($e->getMessage()));
        }
        exit;
    }

    public function show() {
        $items = $this->borrowRepo->getItems($_GET['id']);
        require_once '../app/views/borrows/show.php';
    }
}