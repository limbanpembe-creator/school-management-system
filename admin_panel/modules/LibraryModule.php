<?php

class LibraryModule {
    private $books = [];
    private $issuedBooks = [];
    private $fines = [];

    public function addBook($book) {
        array_push($this->books, $book);
    }

    public function issueBook($bookId, $userId) {
        // Check if book is available and issue it
        if ($this->isBookAvailable($bookId)) {
            $this->issuedBooks[$userId] = $bookId;
            return true;
        }
        return false;
    }

    public function returnBook($userId) {
        if (isset($this->issuedBooks[$userId])) {
            $bookId = $this->issuedBooks[$userId];
            // Calculate fine if overdue
            $fine = $this->calculateFine($userId);
            if ($fine > 0) {
                $this->fines[$userId] = $fine;
            }
            unset($this->issuedBooks[$userId]);
            return true;
        }
        return false;
    }

    private function isBookAvailable($bookId) {
        return !in_array($bookId, $this->issuedBooks);
    }

    public function calculateFine($userId) {
        // Implement your fine calculation logic here, e.g., $1 per day overdue
        $overdueDays = $this->getOverdueDays($userId);
        return max(0, $overdueDays); // Assuming $1 fine for each overdue day
    }

    private function getOverdueDays($userId) {
        // Implement logic to determine overdue days
        return 0; // Placeholder
    }
}

?>