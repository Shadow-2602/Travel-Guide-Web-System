<?php
include 'includes/db.php';

// Get the article ID from URL
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM food_articles WHERE id = $article_id LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  $article = $result->fetch_assoc();
} else {
  $article = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $article ? htmlspecialchars($article['title']) : 'Article Not Found' ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Home Button -->
<div class="home-button">
  <a href="index.php" title="Back to Home">
    <img src="images/home.png" alt="Home">
  </a>
</div>

<?php if ($article): ?>
  <div class="food-article-container">
    <h1><?= htmlspecialchars($article['title']) ?></h1>
    <img src="images/<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" class="article-image">
    <p class="article-description"><?= nl2br(htmlspecialchars($article['description'])) ?></p>
    <hr>
    <div class="full-article-content"><?= nl2br(htmlspecialchars($article['full_content'])) ?></div>
  </div>
<?php else: ?>
  <p style="padding: 2rem; font-size: 1.2rem;">Article not found.</p>
<?php endif; ?>

</body>
</html>