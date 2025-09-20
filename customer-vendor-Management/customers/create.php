<?php
include '../includes/db.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $address = sanitize($_POST['address']);
    $purchasehistory = sanitize($_POST['purchasehistory']);
    $feedback = sanitize($_POST['feedback']);

    // Handle profile image upload
    $profileimage = '';
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
                redirect('create.php', 'Failed to upload profile image.');
                exit;
            }
        } else {
            redirect('create.php', 'Invalid image format or size.');
            exit;
        }
    }

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO customers (name, email, phone, address, profileimage, purchasehistory, feedback) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $address, $profileimage, $purchasehistory, $feedback]);

    redirect('index.php', 'Customer created successfully.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Customer</title>
    <link rel="stylesheet" href="../assets/Css/Index styles.css">
    <link rel="stylesheet" href="../assets/Css/create styles.css">
</head>

<body>
    <div class="box-container">
        <!-- Left Panel -->
        <div class="left-panel">
            <h1>Create New Customer</h1>
            <div class="logo" id="previewBox">
                <span>No Image</span>
            </div>
            <div class="button-box">
                <a href="index.php" class="btn primary">Back to List</a>
            </div>
        </div>
        <!-- Right Panel -->
        <div class="right-panel">
            <h1>Customer Details</h1>
            <?php displayMessage(); ?>
            <form method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Profile Image</td>
                        <td><input type="file" name="profileimage" id="profileInput" accept="image/*"></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name" required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><textarea name="address"></textarea></td>
                    </tr>
                    <tr>
                        <td>Purchase History</td>
                        <td><textarea name="purchasehistory"></textarea></td>
                    </tr>
                    <tr>
                        <td>Feedback</td>
                        <td><textarea name="feedback"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button type="submit">Create</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script src="../assets/js/scripts.js"></script>
</body>

</html>

</html>