<?php
include '../includes/db.php';
include '../includes/functions.php';

// Sanitize inputs
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'name';

// Whitelist allowed filters to avoid SQL injection
$allowedFilters = ['name', 'email', 'phone'];
$filter = in_array($filter, $allowedFilters) ? $filter : 'name';

$query = "SELECT * FROM customers WHERE $filter LIKE :search";
$stmt = $pdo->prepare($query);
$stmt->execute(['search' => "%$search%"]);
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customers List</title>
    <link rel="stylesheet" href="../assets/Css/Index styles.css">
</head>

<body>
    <div class="wrap">
        <main class="hero-card" role="main" aria-labelledby="hero-title">
            <section class="illustration" aria-hidden="false">
                <div class="overlay-card" role="note" aria-label="Quick summary">
                    <h1 class="hero-title" id="hero-title">Customer Management</h1>
                    <p>Easily manage and organize your customers with our intuitive Customer Management system.</p>
                </div>
            </section>

            <?php displayMessage(); ?>

            <!-- Search + Filter -->
            <form method="GET">
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" aria-label="Search customers" placeholder="Search...">
                <select name="filter">
                    <option value="name" <?php if ($filter == 'name') echo 'selected'; ?>>Name</option>
                    <option value="email" <?php if ($filter == 'email') echo 'selected'; ?>>Email</option>
                    <option value="phone" <?php if ($filter == 'phone') echo 'selected'; ?>>Phone</option>
                </select>
                <button type="submit">Search</button>
            </form>

            <!-- Action Buttons -->
            <div class="button-group">
                <a href="create.php" class="btn primary"> + Create New</a>
                <a href="import.php" class="btn">Import CSV</a>
                <a href="export.php?format=csv" class="btn">Export CSV</a>
                <a href="import.php" class="btn">Import Excel</a>
                <a href="export.php" class="btn">Export Excel</a>
            </div>

            <!-- Customers Table -->
            <table class="preview-table" aria-label="Sample customer list preview">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Purchase</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($customers) > 0): ?>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($customer['id']); ?></td>
                                <td><?php echo htmlspecialchars($customer['name']); ?></td>
                                <td><?php echo htmlspecialchars($customer['email']); ?></td>
                                <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                                <td><?php echo htmlspecialchars($customer['purchasehistory']); ?></td>
                                <td>
                                    <a href="profile.php?id=<?php echo $customer['id']; ?>">Profile</a> |
                                    <a href="update.php?id=<?php echo $customer['id']; ?>">Edit</a> |
                                    <a href="delete.php?id=<?php echo $customer['id']; ?>" onclick="return confirmDelete();">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No customers found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Navigation -->
            <div>
                <a href="../index.php" class="btn primary">← Home</a>
                <a href="../vendors/index.php" class="btn primary" style="float: right;">Vendors →</a>
            </div>
        </main>
    </div>

    <script src="../assets/js/scripts.js"></script>
</body>

</html>
