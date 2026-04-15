<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Form</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="header">
    <div class="header-text">
      <h1>Book Your Adventure</h1>
      <p>Fill in your details and we'll be in touch!</p>
    </div>
  </div>

  <div class="container">
    <form method="POST" action="booking_submit.php" class="booking-form">
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" required>

      <label for="contact">Contact Number:</label>
      <input type="text" id="contact" name="contact" required>

      <label for="place">Place to Visit:</label>
      <input type="text" id="place" name="place" required>

      <label for="arrival">Arrival Time:</label>
      <input type="datetime-local" id="arrival" name="arrival" required>

      <label for="leaving">Leaving Time:</label>
      <input type="datetime-local" id="leaving" name="leaving" required>

      <label for="message">Message / Preferences:</label>
      <textarea id="message" name="message" rows="4"></textarea>

      <button type="submit" class="search-btn">Submit Booking</button>
    </form>
  </div>
</body>
</html>
