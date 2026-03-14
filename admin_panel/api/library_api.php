<?php
// Library API for School Management System

header('Content-Type: application/json');

// Sample data for books, issues, and fines
$books = [
    ['id' => 1, 'title' => 'PHP for Beginners', 'author' => 'John Doe', 'available' => true],
    ['id' => 2, 'title' => 'Advanced PHP', 'author' => 'Jane Smith', 'available' => true],
];

$issues = [];
$fines = [];

// Get all books
function getBooks() {
    global $books;
    echo json_encode($books);
}

// Issue a book
function issueBook($bookId, $userId) {
    global $books, $issues;
    foreach ($books as &$book) {
        if ($book['id'] == $bookId && $book['available']) {
            $book['available'] = false;
            $issues[] = ['bookId' => $bookId, 'userId' => $userId, 'dateIssued' => date('Y-m-d H:i:s')];
            echo json_encode(['success' => true, 'message' => 'Book issued successfully.']);
            return;
        }
    }
    echo json_encode(['success' => false, 'message' => 'Book is not available.']);
}

// Return a book
function returnBook($bookId) {
    global $books, $issues;
    foreach ($issues as $key => $issue) {
        if ($issue['bookId'] == $bookId) {
            unset($issues[$key]);
            foreach ($books as &$book) {
                if ($book['id'] == $bookId) {
                    $book['available'] = true;
                    echo json_encode(['success' => true, 'message' => 'Book returned successfully.']);
                    return;
                }
            }
        }
    }
    echo json_encode(['success' => false, 'message' => 'No record found for this book.']);
}

// Track overdue books
function trackOverdue() {
    // This function will track overdue books and apply fines accordingly.
    // Add your implementation here.
}

// Calculate fines
function calculateFine($issueDate) {
    // This function will calculate the fine based on the overdue days.
    // Add your implementation here.
}

// API router
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    getBooks();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['action'])) {
        switch ($data['action']) {
            case 'issue':
                issueBook($data['bookId'], $data['userId']);
                break;
            case 'return':
                returnBook($data['bookId']);
                break;
            case 'trackOverdue':
                trackOverdue();
                break;
            case 'calculateFine':
                echo json_encode(['fine' => calculateFine($data['issueDate'])]);
                break;
            default:
                echo json_encode(['success' => false, 'message' => 'Invalid action.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Unsupported request method.']);
}