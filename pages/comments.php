<?php include '../templates/header.php'; ?>
<?php require '../functions/comment.php'; ?>
<?php
$photoId = $_GET['photo_id'] ?? null;
if (!$photoId) {
    die("Invalid photo.");
}
$comments = getCommentsByPhoto($photoId);
?>

<h1>Comments</h1>
<ul>
    <?php foreach ($comments as $comment): ?>
        <li>
            <strong><?= htmlspecialchars($comment['username']); ?>:</strong> <?= htmlspecialchars($comment['comment']); ?>
        </li>
    <?php endforeach; ?>
</ul>

<form method="POST">
    <textarea name="comment" placeholder="Add a comment" required></textarea>
    <button type="submit">Comment</button>
</form>

<?php include '../templates/footer.php'; ?>
