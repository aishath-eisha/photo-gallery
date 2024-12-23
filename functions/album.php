<?php
require '../config.php';

function createAlbum($userId, $name, $description) {
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO albums (user_id, name, description) VALUES (:user_id, :name, :description)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        return true; // Return true on success
    } catch (PDOException $e) {
        // Log the error or display it
        error_log("Error creating album: " . $e->getMessage());
        return false; // Return false if there is an error
    }
}

// functions/album.php

function deleteAlbum($albumId) {
    global $conn;

    try {
        // First, delete all photos associated with the album
        $stmtPhotos = $conn->prepare("DELETE FROM photos WHERE album_id = :album_id");
        $stmtPhotos->bindParam(':album_id', $albumId);
        $stmtPhotos->execute();

        // Then, delete the album itself
        $stmtAlbum = $conn->prepare("DELETE FROM albums WHERE id = :album_id");
        $stmtAlbum->bindParam(':album_id', $albumId);
        $stmtAlbum->execute();

        return true; // Return true on success
    } catch (PDOException $e) {
        // Log the error or display it
        error_log("Error deleting album: " . $e->getMessage());
        return false; // Return false if there is an error
    }
}

// functions/album.php

function getAlbumsByUser($userId) {
    global $conn;
    try {
        // Fetch albums by user_id
        $stmt = $conn->prepare("SELECT * FROM albums WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all albums as an associative array
    } catch (PDOException $e) {
        // Log the error or display it
        error_log("Error fetching albums for user $userId: " . $e->getMessage());
        return []; // Return an empty array in case of error
    }
}

?>
