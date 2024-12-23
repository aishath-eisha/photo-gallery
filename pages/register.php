<?php include '../templates/header.php'; ?>
<?php require '../functions/user.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (registerUser($username, $email, $password)) {
        echo "Registration successful!";
    } else {
        echo "Error: Unable to register.";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>

<?php include '../templates/footer.php'; ?>
