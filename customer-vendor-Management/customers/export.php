<?php
include '../includes/db.php';
require '../vendor/autoload.php'; // Composer autoload

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Fetch all customers
$stmt = $pdo->query("SELECT * FROM customers");
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['format']) && $_GET['format'] == 'csv') {
    // Export to CSV
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(array_keys($customers[0]), null, 'A1'); // Headers
    $sheet->fromArray($customers, null, 'A2'); // Data

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="customers.csv"');
    $writer = new Csv($spreadsheet);
    $writer->save('php://output');
    exit();
} else {
    // Default to Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(array_keys($customers[0]), null, 'A1');
    $sheet->fromArray($customers, null, 'A2');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="customers.xlsx"');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
}
?>