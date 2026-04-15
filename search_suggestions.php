<?php
include 'includes/db.php';

$term = $_GET['term'] ?? '';
$term = $conn->real_escape_string($term);

$suggestions = [];

if ($term !== '') {
    $sql = "SELECT name FROM destinations WHERE name LIKE '%$term%' LIMIT 5";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['name'];
    }
}

header('Content-Type: application/json');
echo json_encode($suggestions);
?>
