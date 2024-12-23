<?php
require '../config.php';

function addComment($photoId, $userId, $comment) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO comments (photo_id, user_id, comment) VALUES (:photo_id, :user_id, :comment)");
    $stmt->bindParam(':photo_id', $photoId);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':comment', $comment);
    return $stmt->execute();
}

function getCommentsByPhoto($photoId) {
    global $conn;
    $stmt = $conn->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE photo_id = :photo_id");
    $stmt->bindParam(':photo_id', $photoId);
    $stmt->execute();
    return $stmt->fetchAll();
}
?>
