<?php

namespace App\Shared;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelImporter {
    public function importStudentList(string $filePath): array {
        return $this->importExcelFile($filePath, 'students');
    }

    public function importBookList(string $filePath): array {
        return $this->importExcelFile($filePath, 'books');
    }

    private function importExcelFile(string $filePath, string $type): array {
        $data = [];
        if (!file_exists($filePath)) {
            throw new Exception('File not found: ' . $filePath);
        }

        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                $rowData = [];
                foreach ($cellIterator as $cell) {
                    $rowData[] = $cell->getValue();
                }
                $data[] = $this->validateRowData($rowData, $type);
            }
        } catch (Exception $e) {
            throw new Exception('Error reading file: ' . $e->getMessage());
        }

        return $data;
    }

    private function validateRowData(array $rowData, string $type): array {
        // Implement validation logic based on the type ('students' or 'books')
        if ($type === 'students') {
            // Example validation for students
            if (count($rowData) < 3) { // Assume at least 3 columns: ID, Name, Age
                throw new Exception('Invalid student data row: ' . json_encode($rowData));
            }
        } elseif ($type === 'books') {
            // Example validation for books
            if (count($rowData) < 2) { // Assume at least 2 columns: Title, Author
                throw new Exception('Invalid book data row: ' . json_encode($rowData));
            }
        }
        return $rowData;
    }
}
