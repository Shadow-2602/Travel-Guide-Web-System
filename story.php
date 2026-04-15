<?php
include 'includes/db.php';

$id = intval($_GET['id'] ?? 0);

$result = $conn->query("SELECT * FROM stories WHERE id = $id");

if ($result->num_rows === 0) {
    echo "Story not found.";
    exit;
}

$story = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($story['title']) ?> - Travel Story</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Home Icon -->
<div class="home-button">
  <a href="index.php" title="Back to Home">
    <img src="images/home.png" alt="Home">
  </a>
</div>

<div class="story-full">
  <h1><?= htmlspecialchars($story['title']) ?></h1>
  <p class="story-date"><?= htmlspecialchars($story['author']) ?> | <?= htmlspecialchars($story['date']) ?></p>
  <img src="images/<?= htmlspecialchars($story['image']) ?>" alt="<?= htmlspecialchars($story['title']) ?>" class="story-full-image">
  <div class="story-full-content">
    <p><?= nl2br(htmlspecialchars($story['content'])) ?></p>
  </div>
</div>

</body>
</html>
