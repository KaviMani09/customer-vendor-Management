<?php
include '../includes/db.php';
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Delete from database
    $stmt = $pdo->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->execute([$id]);

    redirect('index.php', 'Customer deleted successfully.');
} else {
    redirect('index.php', 'Invalid ID.');
}
?>