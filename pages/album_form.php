<?php include '../templates/header.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<h1>Create New Album</h1>
<form method="POST" action="create_album.php">
    <label for="name">Album Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="description">Description:</label>
    <textarea id="description" name="description"></textarea>
    <br>
    <button type="submit">Create Album</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>

<?php include '../templates/footer.php'; ?>
