<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
 $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $contact = $conn->real_escape_string($_POST['contact']);
  $place = $conn->real_escape_string($_POST['place']);
  $arrival = $conn->real_escape_string($_POST['arrival']);
  $leaving = $conn->real_escape_string($_POST['leaving']);
  $message = $conn->real_escape_string($_POST['message']);

  $sql = "INSERT INTO bookings (name, email, contact, place, arrival, leaving, message) 
          VALUES ('$name', '$email', '$contact', '$place', '$arrival', '$leaving', '$message')";

  if ($conn->query($sql) === TRUE) {
    echo "<p style='padding:2rem;'>Booking successful! Our experts will contact you as soon as possible. Thank you.</p>";
  } else {
    echo "Error: " . $conn->error;
  }
}
?> 
