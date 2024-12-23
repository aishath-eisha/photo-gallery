<?php
require '../config.php';

function uploadPhoto($albumId, $filePath, $caption) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO photos (album_id, file_path, caption) VALUES (:album_id, :file_path, :caption)");
    $stmt->bindParam(':album_id', $albumId);
    $stmt->bindParam(':file_path', $filePath);
    $stmt->bindParam(':caption', $caption);
    return $stmt->execute();
}

function getPhotosByAlbum($albumId) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM photos WHERE album_id = :album_id");
    $stmt->bindParam(':album_id', $albumId);
    $stmt->execute();
    return $stmt->fetchAll();
}

function deletePhoto($photoId) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM photos WHERE id = :photo_id");
    $stmt->bindParam(':photo_id', $photoId);
    return $stmt->execute();
}
?>

