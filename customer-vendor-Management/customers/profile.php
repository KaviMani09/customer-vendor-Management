<?php
include '../includes/db.php';
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
    $stmt->execute([$id]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$customer) {
        redirect('index.php', 'Customer not found.');
    }
} else {
    redirect('index.php', 'Invalid ID.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer Profile</title>
    <link rel="stylesheet" href="../assets/Css/Index styles.css">
    <link rel="stylesheet" href="../assets/Css/profile styles.css">
</head>

<body>
    <div class="container">
        <!-- Left Panel -->
        <div class="left-panel">
            <h2><?php echo htmlspecialchars($customer['name']); ?></h2>
            <div class="sidebar">
                <div class="profile-img">
                    <?php if ($customer['profileimage']): ?>
                        <img src="<?php echo htmlspecialchars($customer['profileimage']); ?>" alt="Profile Image">
                    <?php endif; ?>
                </div>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer['phone']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['email']); ?></p>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <h2>Custamer Details</h2>
            <table class="details-table">
                <tr>
                    <td>Name </td>
                    <td><?php echo htmlspecialchars($customer['name']); ?></td>
                </tr>
                <tr>
                    <td>Phone </td>
                    <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                </tr>
                <tr>
                    <td>Email </td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                </tr>
                <tr>
                    <td>Address </td>
                    <td><?php echo htmlspecialchars($customer['address']); ?></td>
                </tr>
                <tr>
                    <td>Purchase </td>
                    <td><?php echo htmlspecialchars($customer['purchasehistory']); ?></td>
                </tr>
                <tr>
                    <td>Feedback </td>
                    <td><?php echo htmlspecialchars($customer['feedback']); ?></td>
                </tr>
                <tr>
                    <td>Created </td>
                    <td><?php echo htmlspecialchars($customer['created_at']); ?></td>
                </tr>
            </table>
            <a href="index.php">Back to List</a>
        </div>
    </div>
</body>

</html>