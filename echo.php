<?php
include "./conn.php"; // Ensure conn.php has the database connection details

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = trim($_POST['item_id']); // Trim whitespace from input

  echo "Select Item Id: ". $item_id;
}

$conn->close();
?>
