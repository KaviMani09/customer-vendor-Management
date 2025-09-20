<?php
include '../includes/db.php';
include '../includes/functions.php';

$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'name';

// Ensure the filter is a valid column to prevent SQL injection
$valid_filters = ['name', 'email'];
if (!in_array($filter, $valid_filters)) {
    $filter = 'name';
}

$query = "SELECT * FROM vendors WHERE $filter LIKE :search";
$stmt = $pdo->prepare($query);
$stmt->execute(['search' => "%$search%"]);
$vendors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendors List</title>
     <link rel="stylesheet" href="../assets/Css/Index styles.css">
</head>

<body>
    <div class="wrap">
        <main class="hero-card hero-card-1" role="main" aria-labelledby="hero-title">
            <section class="illustration" aria-hidden="false">
                <div class="overlay-card overlay-1" role="note" aria-label="Quick summary">
                    <h1 class="hero-title" id="hero-title">Vendors Management</h1>
                    <p>Our Vendors Management platform empowers businesses to organize, monitor, and optimize vendor data, ensuring seamless collaboration and enhanced operational efficiency.</p>
                </div>
            </section>

            <?php displayMessage(); ?>

            <!-- Search + Filter -->
            <form method="GET">
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search...">
                <select name="filter">
                    <option value="name" <?php if ($filter == 'name') echo 'selected'; ?>>Name</option>
                    <option value="email" <?php if ($filter == 'email') echo 'selected'; ?>>Email</option>
                    <option value="phone" <?php if ($filter == 'phone') echo 'selected'; ?>>Phone</option>
                </select>
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

            <!-- Vendors Table -->
            <table class="preview-table" aria-label="Vendors list preview">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($vendors) > 0): ?>
                        <?php foreach ($vendors as $vendor): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($vendor['id']); ?></td>
                                <td><?php echo htmlspecialchars($vendor['name']); ?></td>
                                <td><?php echo htmlspecialchars($vendor['email']); ?></td>
                                <td><?php echo htmlspecialchars($vendor['phone'] ?: 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($vendor['company_name'] ?: 'N/A'); ?></td>
                                <td>
                                    <a href="profile.php?id=<?php echo $vendor['id']; ?>">Profile</a> |
                                    <a href="update.php?id=<?php echo $vendor['id']; ?>">Edit</a> |
                                    <a href="delete.php?id=<?php echo $vendor['id']; ?>" onclick="return confirmDelete();">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No vendors found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Navigation -->
            <div>
                <a href="../index.php" class="btn primary">← Home</a>
                <a href="../customers/index.php" class="btn primary" style="float: right;">Customers →</a>
            </div>
        </main>
    </div>

    <script src="../assets/js/scripts.js"></script>
</body>

</html>
