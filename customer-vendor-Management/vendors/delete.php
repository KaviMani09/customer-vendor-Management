<?php
include '../includes/db.php';
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM vendors WHERE id = ?");
    $stmt->execute([$id]);

    redirect('index.php', 'Vendor deleted successfully.');
} else {
    redirect('index.php', 'Invalid ID.');
}
?>