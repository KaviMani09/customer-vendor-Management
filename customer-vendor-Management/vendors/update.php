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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $address = sanitize($_POST['address']);
    $company_name = sanitize($_POST['company_name']);
    $product_service = sanitize($_POST['product_service']);
    $contract_start = sanitize($_POST['contract_start']);
    $contract_end = sanitize($_POST['contract_end']);
    $payment_terms = sanitize($_POST['payment_terms']);
    $feedback = sanitize($_POST['feedback']);

    // Handle profile image upload
    $profileimage = $vendor['profileimage'];
    if (isset($_FILES['profileimage']) && $_FILES['profileimage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileName = uniqid() . '_' . basename($_FILES['profileimage']['name']);
        $uploadPath = $uploadDir . $fileName;
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if (in_array($_FILES['profileimage']['type'], $allowedTypes) && $_FILES['profileimage']['size'] <= $maxFileSize) {
            if (move_uploaded_file($_FILES['profileimage']['tmp_name'], $uploadPath)) {
                $profileimage = $uploadPath;
            } else {
                redirect('update.php?id=' . $id, 'Failed to upload profile image.');
                exit;
            }
        } else {
            redirect('update.php?id=' . $id, 'Invalid image format or size.');
            exit;
        }
    }

    // Update database
    $stmt = $pdo->prepare("UPDATE vendors 
                           SET name = ?, email = ?, phone = ?, address = ?, profileimage = ?, company_name = ?, product_service = ?, contract_start = ?, contract_end = ?, payment_terms = ?, feedback = ? 
                           WHERE id = ?");
    $stmt->execute([$name, $email, $phone, $address, $profileimage, $company_name, $product_service, $contract_start, $contract_end, $payment_terms, $feedback, $id]);

    redirect('index.php', 'Vendor updated successfully.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Vendor</title>
    <link rel="stylesheet" href="../assets/Css/customer & vendor/Index styles.css">
    <link rel="stylesheet" href="../assets/Css/customer & vendor/update styles.css">
</head>

<body>
    <h1>Update Vendor</h1>
    <?php displayMessage(); ?>
    <form method="POST" enctype="multipart/form-data">
        <label>Profile Image:</label>
        <input type="file" name="profileimage" accept="image/*">
        <?php if (!empty($vendor['profileimage'])): ?>
            <p>Current Image: <img src="<?php echo htmlspecialchars($vendor['profileimage']); ?>" alt="Profile Image" width="100"></p>
        <?php endif; ?>

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($vendor['name']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($vendor['email']); ?>" required>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($vendor['phone']); ?>" required>

        <label>Address:</label>
        <textarea name="address"><?php echo htmlspecialchars($vendor['address']); ?></textarea>

        <label>Company Name:</label>
        <input type="text" name="company_name" value="<?php echo htmlspecialchars($vendor['company_name']); ?>">

        <label>Product/Service:</label>
        <textarea name="product_service"><?php echo htmlspecialchars($vendor['product_service']); ?></textarea>

        <label>Contract Start:</label>
        <input type="date" name="contract_start" value="<?php echo htmlspecialchars($vendor['contract_start']); ?>">

        <label>Contract End:</label>
        <input type="date" name="contract_end" value="<?php echo htmlspecialchars($vendor['contract_end']); ?>">

        <label>Payment Terms:</label>
        <textarea name="payment_terms"><?php echo htmlspecialchars($vendor['payment_terms']); ?></textarea>

        <label>Feedback:</label>
        <textarea name="feedback"><?php echo htmlspecialchars($vendor['feedback']); ?></textarea>

        <button type="submit">Update</button>
    </form>
    <a href="index.php">Back to List</a>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>