<?php include '../templates/header.php'; ?>
<?php require '../functions/user.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (loginUser($email, $password)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid credentials.";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<?php include '../templates/footer.php'; ?>
