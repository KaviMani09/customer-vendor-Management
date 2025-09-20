<?php
// Database connection settings
$host = 'localhost';
$dbname = 'management';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Success message
    echo '<div id="success-message" style="
        position: fixed; 
        top: 30px; 
        left: 50%; 
        transform: translateX(-50%);
        background-color: #d4edda; 
        color: #155724; 
        padding: 10px 20px; 
        border: 1px solid #c3e6cb; 
        border-radius: 5px;
        font-weight: bold;
        z-index: 1000;
    ">Connected successfully!</div>';
} catch (PDOException $e) {
    die('<div style="color: red; font-weight: bold;">Connection failed: ' . $e->getMessage() . '</div>');
}
?>

<script>
// Hide the message after 6 seconds
document.addEventListener('DOMContentLoaded', function() {
    const message = document.getElementById('success-message');
    if (message) {
        setTimeout(() => {
            message.style.display = 'none';
        }, 1000);
    }
});
</script>
