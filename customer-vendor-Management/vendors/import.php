<?php
include '../includes/db.php';
include '../includes/functions.php';
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle CSV Import
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === 0) {
        $file = $_FILES['csv_file']['tmp_name'];
        if (filesize($file) > 0 && ($handle = fopen($file, 'r')) !== FALSE) {
            fgetcsv($handle); // Skip header row
            while (($data = fgetcsv($handle)) !== FALSE) {
                $name           = sanitize($data[1] ?? '');
                $email          = sanitize($data[2] ?? '');
                $phone          = sanitize($data[3] ?? '');
                $address        = sanitize($data[4] ?? '');
                $profileimage   = sanitize($data[5] ?? '');
                $company_name   = sanitize($data[6] ?? '');
                $product_service= sanitize($data[7] ?? '');
                $contract_start = sanitize($data[8] ?? '');
                $contract_end   = sanitize($data[9] ?? '');
                $payment_terms  = sanitize($data[10] ?? '');
                $feedback       = sanitize($data[11] ?? '');

                $stmt = $pdo->prepare("
                    INSERT INTO vendors 
                    (name, email, phone, address, profileimage, company_name, product_service, contract_start, contract_end, payment_terms, feedback) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([
                    $name, $email, $phone, $address, 
                    $profileimage, $company_name, $product_service, 
                    $contract_start, $contract_end, $payment_terms, $feedback
                ]);
            }
            fclose($handle);
            redirect('index.php', 'CSV import successful.');
        } else {
            redirect('index.php', 'CSV file is empty or invalid.');
        }
    }

    // Handle Excel Import
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === 0) {
        $excelMimes = [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
        if (in_array($_FILES['excel_file']['type'], $excelMimes)) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet()->toArray();
            unset($worksheet[0]); // Remove header row

            foreach ($worksheet as $row) {
                $name           = sanitize($row[1] ?? '');
                $email          = sanitize($row[2] ?? '');
                $phone          = sanitize($row[3] ?? '');
                $address        = sanitize($row[4] ?? '');
                $profileimage   = sanitize($row[5] ?? '');
                $company_name   = sanitize($row[6] ?? '');
                $product_service= sanitize($row[7] ?? '');
                $contract_start = sanitize($row[8] ?? '');
                $contract_end   = sanitize($row[9] ?? '');
                $payment_terms  = sanitize($row[10] ?? '');
                $feedback       = sanitize($row[11] ?? '');

                $stmt = $pdo->prepare("
                    INSERT INTO vendors 
                    (name, email, phone, address, profileimage, company_name, product_service, contract_start, contract_end, payment_terms, feedback) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([
                    $name, $email, $phone, $address, 
                    $profileimage, $company_name, $product_service, 
                    $contract_start, $contract_end, $payment_terms, $feedback
                ]);
            }
            redirect('index.php', 'Excel import successful.');
        } else {
            redirect('index.php', 'Invalid Excel file format.');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import Vendors</title>
    <link rel="stylesheet" href="../assets/Css/Index styles.css">
    <link rel="stylesheet" href="../assets/Css/import styles.css">
</head>
<body>
    <div class="container">
        <!-- Left Panel -->
        <div class="left-panel">
            <h1>Vendors</h1>
            <?php displayMessage(); ?>

            <h2>CSV Import</h2>
            <form method="POST" enctype="multipart/form-data">
                <label>CSV File:</label>
                <input type="file" name="csv_file" required accept=".csv">
                <button type="submit">Import CSV</button>
            </form>

            <h2>Excel Import</h2>
            <form method="POST" enctype="multipart/form-data">
                <label>Excel File:</label>
                <input type="file" name="excel_file" required accept=".xls,.xlsx">
                <button type="submit">Import Excel</button>
            </form>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <h2>Instructions</h2>
            <p>
                File format should be:<br>
                <code>id, name, email, phone, address, profileimage, company_name, product_service, contract_start, contract_end, payment_terms, feedback</code><br>
                (id will be ignored).
            </p>
            <a href="index.php" class="back-link">⬅ Back to List</a>
        </div>
    </div>
</body>
</html>
