<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Travel Guide</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
 <div class="header">
  <div class="header-text">
    <h1>Teddy Travel Guide</h1>
    <p>Explore amazing destinations around the world!</p>
  </div>

  <div class="search-bar-wrapper">
    <form method="GET" action="" autocomplete="off">
      <div class="search-wrapper">
        <input type="text" name="search" id="searchInput" class="search-input" placeholder="Search destinations..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <ul id="suggestions" class="suggestions-list"></ul>
      </div>

      <select name="locationFilter" class="filter-select">
        <option value="">All Locations</option>
        <option value="Japan" <?= ($_GET['locationFilter'] ?? '') === 'Japan' ? 'selected' : '' ?>>Japan</option>
        <option value="France" <?= ($_GET['locationFilter'] ?? '') === 'France' ? 'selected' : '' ?>>France</option>
        <option value="USA" <?= ($_GET['locationFilter'] ?? '') === 'USA' ? 'selected' : '' ?>>USA</option>
      </select>

      <button type="submit" class="search-btn">Search</button>
    </form>
  </div>
</div>



  <div class="container">
    <?php
    $search = $_GET['search'] ?? '';
$filter = $_GET['locationFilter'] ?? '';
$search = $conn->real_escape_string($search);
$filter = $conn->real_escape_string($filter);

if ($search !== '' || $filter !== '') {
    // User is searching: ignore visibility
    $sql = "SELECT * FROM destinations WHERE 1";

    if ($search !== '') {
        $sql .= " AND (name LIKE '%$search%' OR location LIKE '%$search%')";
    }

    if ($filter !== '') {
        $sql .= " AND location = '$filter'";
    }

} else {
    // Default view: show only visible destinations
    $sql = "SELECT * FROM destinations WHERE visibility = 1";
}

$result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
       echo "<div class='card fade-in'>";
$searchParam = urlencode($_GET['search'] ?? '');
$filterParam = urlencode($_GET['locationFilter'] ?? '');
echo "<a href='details.php?id={$row['id']}&search=$searchParam&locationFilter=$filterParam'><img src='images/{$row['image']}' alt='{$row['name']}'></a>";
echo "<div class='card-body'>";
echo "<h3>{$row['name']}</h3>";
echo "<p>{$row['description']}</p>";
echo "<p><strong>Location:</strong> {$row['location']}</p>";
echo "</div>"; // end card-body

echo "</div>"; // end card

      }
    } else {
      echo "<p>No destinations available.</p>";
    }
    ?>
  </div>
<!-- Travel Stories & News Section -->
<div class="stories-section">
  <div class="stories-overlay">
    <div class="stories-content">
      <h2>Discover Inspiring Travel Stories</h2>
      <p>Explore articles, tips, and news from travelers around the world.</p>
      <a href="stories.php" class="btn-discover">Read Stories</a>
    </div>
  </div>
</div>

<!-- Food & Drinks Section -->
<div class="food-section">
  <h2>Food & Drinks</h2>

  <?php
  $food_sql = "SELECT * FROM food_articles LIMIT 3";
  $food_result = $conn->query($food_sql);

  if ($food_result->num_rows > 0) {
    while ($food = $food_result->fetch_assoc()) {
      echo "<div class='food-row'>";
      
      // Left side: background image card
      echo "<div class='food-image-card' style='background-image: url(images/{$food['image']});'>";
      echo "<div class='food-text-overlay'>";
      echo "<h3>{$food['title']}</h3>";
      echo "<p>{$food['description']}</p>";
      echo "</div>";
      echo "</div>";

      // Right side: button to detailed article
      echo "<div class='food-action'>";
      echo "<a href='{$food['link']}' class='read-more-btn'>Read Full Article</a>";
      echo "</div>";

      echo "</div>"; // end food-row
    }
  } else {
    echo "<p>No food articles available.</p>";
  }
  ?>
</div>

<script>
  const cards = document.querySelectorAll('.fade-in');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target); // Only animate once
      }
    });
  });

  cards.forEach(card => observer.observe(card));
</script>
<script>
const searchInput = document.getElementById('searchInput');
const suggestionsList = document.getElementById('suggestions');

searchInput.addEventListener('input', function () {
  const query = this.value;

  if (query.length === 0) {
    suggestionsList.innerHTML = '';
    return;
  }

  fetch(`search_suggestions.php?term=${encodeURIComponent(query)}`)
    .then(response => response.json())
    .then(data => {
      suggestionsList.innerHTML = '';
      data.forEach(item => {
        const li = document.createElement('li');
        li.textContent = item;
        li.addEventListener('click', function () {
          searchInput.value = this.textContent;
          suggestionsList.innerHTML = '';
        });
        suggestionsList.appendChild(li);
      });
    });
});
</script>

<div class="animated-video-section">
  <video autoplay loop muted playsinline>
    <source src="videos/teddyaroundtheworld.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
 <div class="video-overlay">
<div class="video-text">
    <h2>Explore the World with Us!</h2>
    <p>From iconic cities to hidden gems, your journey starts here.</p>
    <a href="booking.php" class="book-btn">Book Now</a>
  </div>
</div>
</div>

</body>
</html>
