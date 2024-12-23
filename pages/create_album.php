<?php 
require '../config.php'; 
session_start(); 

function createAlbum($userId, $name, $description) {
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO albums (user_id, name, description) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $name, $description]);
    } catch (PDOException $e) {
        error_log("Error creating album: " . $e->getMessage());
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $userId = $_SESSION['user_id'] ?? null;
    if (!$userId) {
        die("User not logged in.");
    }
    
    $name = $_POST['name'] ?? ''; 
    $description = $_POST['description'] ?? ''; 
 
    if (empty($name)) { 
        die("Album name is required."); 
    } 
 
    if (createAlbum($userId, $name, $description)) { 
        header("Location: dashboard.php?message=Album created successfully"); 
        exit; 
    } else { 
        die("Error creating album."); 
    } 
} 

header("Location: album_form.php");
exit;
?>