<?php
session_start();
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../functions/photo.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$albumId = $_GET['album_id'] ?? null;
if (!$albumId) {
    die("Album not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . '_' . basename($_FILES['photo']['name']);
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $filePath)) {
        $caption = $_POST['caption'] ?? '';
        if (uploadPhoto($albumId, 'uploads/' . $fileName, $caption)) {
            header("Location: view_album.php?album_id=" . $albumId . "&message=Photo uploaded successfully");
            exit;
        }
        echo "Error uploading photo to database.";
    } else {
        echo "File upload failed.";
    }
}
?>

<?php include __DIR__ . '/../templates/header.php'; ?>

<h1>Upload Photo</h1>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="photo" accept="image/*" required>
    <input type="text" name="caption" placeholder="Photo Caption">
    <button type="submit">Upload</button>
</form>

<a href="view_album.php?album_id=<?= htmlspecialchars($albumId); ?>">Back to Album</a>

<?php include __DIR__ . '/../templates/footer.php'; ?>