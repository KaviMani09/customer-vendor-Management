<?php
include '../includes/db.php';
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM vendors WHERE id = ?");
    $stmt->execute([$id]);
    $vendor = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vendor) {
        redirect('index.php', 'Vendor not found.');
    }
} else {
    redirect('index.php', 'Invalid ID.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vendor Profile</title>
     <link rel="stylesheet" href="../assets/Css/Index styles.css">
    <link rel="stylesheet" href="../assets/Css/profile styles.css">
    <style>
      
    </style>
</head>

<body>
    <div class="container">
        <!-- Left Panel -->
        <div class="left-panel">
            <h2><?php echo htmlspecialchars($vendor['name']); ?></h2>
            <div class="sidebar">
                <div class="profile-img">
                    <?php if ($vendor['profileimage']): ?>
                        <img src="<?php echo htmlspecialchars($vendor['profileimage']); ?>" alt="Profile Image">
                    <?php endif; ?>
                </div>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($vendor['phone']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($vendor['email']); ?></p>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <h2>Vendor Details</h2>
            <table class="details-table">
                <tr>
                    <td>Name </td>
                    <td><?php echo htmlspecialchars($vendor['name']); ?></td>
                </tr>
                <tr>
                    <td>Phone </td>
                    <td><?php echo htmlspecialchars($vendor['phone']); ?></td>
                </tr>
                <tr>
                    <td>Email </td>
                    <td><?php echo htmlspecialchars($vendor['email']); ?></td>
                </tr>
                <tr>
                    <td>Address </td>
                    <td><?php echo htmlspecialchars($vendor['address']); ?></td>
                </tr>
                <tr>
                    <td>Company Name </td>
                    <td><?php echo htmlspecialchars($vendor['company_name']); ?></td>
                </tr>
                <tr>
                    <td>Product/Service </td>
                    <td><?php echo htmlspecialchars($vendor['product_service']); ?></td>
                </tr>
                <tr>
                    <td>Contract Start Date </td>
                    <td><?php echo htmlspecialchars($vendor['contract_start']); ?></td>
                </tr>
                <tr>
                    <td>Contract End Date </td>
                    <td><?php echo htmlspecialchars($vendor['contract_end']); ?></td>
                </tr>
                <tr>
                    <td>Payment Terms </td>
                    <td><?php echo htmlspecialchars($vendor['payment_terms']); ?></td>
                </tr>
                <tr>
                    <td>Feedback </td>
                    <td><?php echo htmlspecialchars($vendor['feedback']); ?></td>
                </tr>
                <tr>
                    <td>Created </td>
                    <td><?php echo htmlspecialchars($vendor['created_at']); ?></td>
                </tr>
            </table>
            <a href="index.php">Back to List</a>
        </div>
    </div>
</body>

</html>