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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $profileimage = '';
    if (isset($_FILES['profileimage']) && $_FILES['profileimage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileName = uniqid() . '_' . basename($_FILES['profileimage']['name']);
        $uploadPath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['profileimage']['tmp_name'], $uploadPath)) {
            $profileimage = $uploadPath;
        } else {
            redirect('update.php?id=' . $id, 'Failed to upload profile image.');
            exit;
        }
    } else {
        $profileimage = $customer['profileimage']; // Keep existing image if no new upload
    }

    // New fields
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $address = sanitize($_POST['address']);
    $purchasehistory = sanitize($_POST['purchasehistory']);
    $feedback = sanitize($_POST['feedback']);

    // Update database
    $stmt = $pdo->prepare("UPDATE customers 
                           SET name = ?, email = ?, phone = ?, address = ?, profileimage = ?, purchasehistory = ?, feedback = ? 
                           WHERE id = ?");
    $stmt->execute([$name, $email, $phone, $address, $profileimage, $purchasehistory, $feedback, $id]);

    redirect('index.php', 'Customer updated successfully.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Customer</title>
    <link rel="stylesheet" href="../assets/Css/Index styles.css">
    <link rel="stylesheet" href="../assets/Css/update styles.css">
</head>

<body>
    <h1>Update Customer</h1>
    <?php displayMessage(); ?>
    <form method="POST" enctype="multipart/form-data">
        <label>Profile Image:</label>
        <input type="file" name="profileimage" accept="image/*">
        <?php if (!empty($customer['profileimage'])): ?>
            <p>Current Image: <img src="<?php echo $customer['profileimage']; ?>" alt="Profile Image" width="100"></p>
        <?php endif; ?>

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($customer['name']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>

        <label>Address:</label>
        <textarea name="address" required><?php echo htmlspecialchars($customer['address']); ?></textarea>

        <label>Purchase History:</label>
        <textarea name="purchasehistory"><?php echo htmlspecialchars($customer['purchasehistory']); ?></textarea>

        <label>Feedback:</label>
        <textarea name="feedback"><?php echo htmlspecialchars($customer['feedback']); ?></textarea>

        <button type="submit">Update</button>
    </form>
    <a href="index.php">Back to List</a>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>