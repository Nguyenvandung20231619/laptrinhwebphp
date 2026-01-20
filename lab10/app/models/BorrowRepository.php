<?php
class BorrowRepository {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function getAll() {
        return $this->pdo->query("SELECT b.*, br.full_name FROM borrows b JOIN borrowers br ON b.borrower_id = br.id ORDER BY b.id DESC")->fetchAll();
    }

    public function getItems($id) {
        $stmt = $this->pdo->prepare("SELECT bi.*, bk.title FROM borrow_items bi JOIN books bk ON bi.book_id = bk.id WHERE bi.borrow_id = ?");
        $stmt->execute([(int)$id]);
        return $stmt->fetchAll();
    }

    public function storeBorrow($borrower_id, $items, $note) {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO borrows (borrower_id, borrow_date, note) VALUES (?, CURDATE(), ?)");
            $stmt->execute([(int)$borrower_id, $note]);
            $borrow_id = $this->pdo->lastInsertId();

            foreach ($items as $book_id => $qty) {
                $stmtCheck = $this->pdo->prepare("SELECT qty, title FROM books WHERE id = ? FOR UPDATE");
                $stmtCheck->execute([(int)$book_id]);
                $book = $stmtCheck->fetch();

                if (!$book || $book['qty'] < $qty) {
                    throw new Exception("Sách '{$book['title']}' không đủ tồn kho!");
                }

                $this->pdo->prepare("INSERT INTO borrow_items (borrow_id, book_id, qty) VALUES (?, ?, ?)")
                          ->execute([$borrow_id, (int)$book_id, (int)$qty]);

                $this->pdo->prepare("UPDATE books SET qty = qty - ? WHERE id = ?")
                          ->execute([(int)$qty, (int)$book_id]);
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}