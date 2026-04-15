<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Travel Stories Slideshow</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .slideshow-container {
      position: relative;
      max-width: 800px;
      margin: auto;
      padding: 2rem;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .slide {
      display: none;
      text-align: center;
    }

    .slide img {
      width: 100%;
      max-height: 400px;
      object-fit: cover;
      border-radius: 10px;
    }

    .slide h2 {
      margin-top: 1rem;
      color: #2c3e50;
    }

    .slide p {
      color: #555;
      line-height: 1.6;
    }

    .nav-buttons {
      text-align: center;
      margin-top: 1rem;
    }

    .nav-buttons button {
      padding: 0.6rem 1.2rem;
      margin: 0 10px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .nav-buttons button:hover {
      background-color: #2980b9;
    }

    .home-button {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1000;
    }

    .home-button img {
      width: 40px;
      height: 40px;
    }
  </style>
</head>
<body>

<div class="home-button">
  <a href="index.php"><img src="images/home.png" alt="Home"></a>
</div>

<div class="slideshow-container">
  <?php
$sql = "SELECT * FROM stories ORDER BY date DESC";
$result = $conn->query($sql);
$index = 0;

if ($result->num_rows > 0) {
  $stories = [];
  while ($story1 = $result->fetch_assoc()) {
    // Attempt to get second story (may be null if none left)
    $story2 = $result->fetch_assoc();

    echo "<div class='slide'>";

    // Story 1
    echo "<div class='story-card'>";
    echo "<div class='story-image'><img src='images/{$story1['image']}' alt='{$story1['title']}'></div>";
    echo "<div class='story-content'>";
    echo "<h2>{$story1['title']}</h2>";
    echo "<p class='story-meta'><em>By {$story1['author']} on {$story1['date']}</em></p>";
    echo "<p>{$story1['content']}</p>";
    echo "</div>";
    echo "</div>";

    // Story 2 (only if it exists)
    if ($story2) {
        echo "<div class='story-card'>";
        echo "<div class='story-image'><img src='images/{$story2['image']}' alt='{$story2['title']}'></div>";
        echo "<div class='story-content'>";
        echo "<h2>{$story2['title']}</h2>";
        echo "<p class='story-meta'><em>By {$story2['author']} on {$story2['date']}</em></p>";
        echo "<p>{$story2['content']}</p>";
        echo "</div>";
        echo "</div>";
    }

    echo "</div>"; // close .slide-row
}

} else {
  echo "<p>No stories available.</p>";
}
?>
  
  <div class="nav-buttons">
    <button onclick="plusSlides(-1)">Previous</button>
    <button onclick="plusSlides(1)">Next</button>
  </div>
</div>

<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');

  function showSlide(n) {
    slides.forEach((slide, index) => {
      slide.style.display = index === n ? 'block' : 'none';
    });
  }

  function plusSlides(n) {
    currentSlide += n;
    if (currentSlide >= slides.length) currentSlide = 0;
    if (currentSlide < 0) currentSlide = slides.length - 1;
    showSlide(currentSlide);
  }

  // Show the first slide by default
  showSlide(currentSlide);
</script>

</body>
</html>
