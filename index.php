<?php 
include 'templates/header.php';

if (isset($_SESSION['user_id'])) {
    echo '<h1>Welcome back to ImageHive!</h1>';
    echo '<p>Start creating and sharing your photo albums!</p>';
} else {
    echo '<h1>Welcome to ImageHive</h1>';
    echo '<p>Create and share your photo albums!</p>';
    echo '<a href="pages/register.php">Register</a> | <a href="pages/login.php">Login</a>';
}

include 'templates/footer.php'; 
?>