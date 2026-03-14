<?php

namespace AdminPanel\Modules;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelImporter {
    public function importStudents($filePath) {
        $spreadsheet = IOFactory::load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $students = [];

        foreach ($sheetData as $row) {
            // Assuming first column is name, second is email, etc.
            $students[] = [
                'name' => $row['A'],
                'email' => $row['B'],
            ];
        }
        return $students;
    }

    public function importBooks($filePath) {
        $spreadsheet = IOFactory::load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $books = [];

        foreach ($sheetData as $row) {
            // Assuming first column is title, second is author, etc.
            $books[] = [
                'title' => $row['A'],
                'author' => $row['B'],
            ];
        }
        return $books;
    }
}

?>