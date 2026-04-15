<?php
include 'includes/db.php';

$id = $_GET['id'] ?? 0;
$id = intval($id);

$result = $conn->query("SELECT * FROM destinations WHERE id = $id");

if ($result->num_rows == 0) {
    echo "Destination not found.";
    exit;
}

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title><?= $row['name'] ?> - Details</title>
  <link rel="stylesheet" href="css/style.css">
</head>
  <body style="margin: 0;">
  <!-- Background Image -->
  <div class="background-image" style="background-image: url('images/<?= $row['image'] ?>');">
    <div class="overlay">
      <!-- Recommended Places Section -->
      <div class="recommended-container">
        <h1 class="destination-name"><?= $row['name'] ?></h1>
        <h2>Recommended Places</h2>

        <?php
        $destId = $row['id'];
        $recQuery = "SELECT * FROM recommended_places WHERE destination_id = $destId";
        $recResult = $conn->query($recQuery);

        if ($recResult->num_rows > 0) {
          while ($rec = $recResult->fetch_assoc()) {
            echo "<div class='place-card'>";
            echo "<img src='images/{$rec['place_image']}' alt='{$rec['place_name']}'>";
            echo "<div class='place-info'>";
            echo "<h4>{$rec['place_name']}</h4>";
            echo "<p>{$rec['place_description']}</p>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "<p>No recommended places found.</p>";
        }
        ?>
      </div>
    </div>
<div class="home-button">
  <a href="index.php" title="Back to Home">
    <img src="images/home.png" alt="Home" />
  </a>
</div>
<?php
$search = $_GET['search'] ?? '';
$locationFilter = $_GET['locationFilter'] ?? '';
$backUrl = "index.php?search=" . urlencode($search) . "&locationFilter=" . urlencode($locationFilter);
?>

<div class="back-icon">
  <a href="<?= $backUrl ?>" title="Back to Results">
    <img src="images/back.png" alt="Back" class="back-icon">
  </a>
</div>

  </div>
</body>
</html>
