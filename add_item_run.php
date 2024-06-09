<?php
include "./conn.php"; // Ensure conn.php has the database connection details

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = trim($_POST['item_name']); // Trim whitespace from input

    // Check if item_name is not empty
    if (!empty($item_name)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO item (item_name) VALUES (?)");
        if ($stmt) {
            $stmt->bind_param("s", $item_name);

            if ($stmt->execute()) {
                $add_new_item = "New Item added successfully";
                // Redirect back to the feedback page with the success message
                header("Location: ./index.php?add_new_item=" . urlencode($add_new_item));
                exit();
            } else {
                $error_add_new_item = "Error: " . $stmt->error;
                // Redirect back to the feedback page with the error message
                header("Location: ./index.php?error_add_new_item=" . urlencode($error_add_new_item));
                exit();
            }

            $stmt->close();
        } else {
            $error_add_new_item = "Error preparing statement: " . $conn->error;
            // Redirect back to the feedback page with the error message
            header("Location: ./index.php?error_add_new_item=" . urlencode($error_add_new_item));
            exit();
        }
    } else {
        $error_add_new_item = "Item name cannot be empty";
        // Redirect back to the feedback page with the error message
        header("Location: ./index.php?error_add_new_item=" . urlencode($error_add_new_item));
        exit();
    }
}

$conn->close();
?>
