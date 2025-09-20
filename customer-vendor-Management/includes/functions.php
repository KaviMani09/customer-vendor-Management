<?php
// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to redirect with message (used in CRUD operations)
function redirect($location, $message = '') {
    if ($message) {
        $_SESSION['message'] = $message;
    }
    header("Location: $location");
    exit();
}

// Display session message if set
function displayMessage() {
    if (isset($_SESSION['message'])) {
        echo '<p class="error">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
}
?>