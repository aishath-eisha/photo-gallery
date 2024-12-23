<?php include '../templates/header.php'; ?>
<?php require '../functions/photo.php'; ?>
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$albumId = $_GET['album_id'] ?? null;
if (!$albumId) {
    die("Album not found.");
}

// Fetch the album details to ensure it belongs to the current user
require '../functions/album.php';
global $conn;
$stmt = $conn->prepare("SELECT * FROM albums WHERE id = :album_id AND user_id = :user_id");
$stmt->bindParam(':album_id', $albumId);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$album = $stmt->fetch();

if (!$album) {
    die("You do not have permission to view or delete this album.");
}

// Handle photo deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_photo_id'])) {
    $photoId = $_POST['delete_photo_id'];
    if (deletePhoto($photoId)) {
        echo "Photo deleted successfully.";
    } else {
        echo "Error deleting photo.";
    }
}

// Fetch photos for the album
$photos = getPhotosByAlbum($albumId);
?>

<h1>View Album: <?= htmlspecialchars($album['name']); ?></h1>

<?php if (empty($photos)): ?>
    <p style="color: grey; font-style: italic; font-size: 18px;">Such empty.</p>
    <p style="color: grey; font-style: italic; font-size: 18px;">Add your work?</p>
<?php else: ?>
    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
        <?php foreach ($photos as $photo): ?>
            <div style="border: 1px solid #ccc; padding: 10px;">
                <img src="../<?= htmlspecialchars($photo['file_path']); ?>" alt="<?= htmlspecialchars($photo['caption']); ?>" style="width: 200px; height: auto;">
                <p><?= htmlspecialchars($photo['caption']); ?></p>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="delete_photo_id" value="<?= $photo['id']; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this photo?')">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<a href="upload_photos.php?album_id=<?= $albumId; ?>">Upload Photos</a>

<?php include '../templates/footer.php'; ?>
