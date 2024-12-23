<?php include '../templates/header.php'; ?>
<?php require '../functions/album.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$userId = $_SESSION['user_id'];
$albums = getAlbumsByUser($userId);

$message = ""; // For storing feedback messages

// Handle album deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_album_id'])) {
    $albumId = $_POST['delete_album_id'];
    if (deleteAlbum($albumId)) {
        $message = "Album deleted successfully.";
    } else {
        $message = "Error deleting album.";
    }
    $albums = getAlbumsByUser($userId); // Refresh the album list
}
?>

<h1>Your Dashboard</h1>
<a href="album_form.php">Create New Album</a>

<?php if ($message): ?>
    <div class="message"><?= htmlspecialchars($message); ?></div>
<?php endif; ?>

<ul>
    <?php foreach ($albums as $album): ?>
        <li>
            <strong><?= htmlspecialchars($album['name']); ?></strong>
            <p><?= htmlspecialchars($album['description']); ?></p>
            <a href="upload_photos.php?album_id=<?= $album['id']; ?>">Upload Photos</a> |
            <a href="view_album.php?album_id=<?= $album['id']; ?>">View Album</a>
            <form method="POST" style="display: inline;">
                <input type="hidden" name="delete_album_id" value="<?= $album['id']; ?>">
                <button type="submit" onclick="return confirm('Are you sure you want to delete this album?')">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../templates/footer.php'; ?>
