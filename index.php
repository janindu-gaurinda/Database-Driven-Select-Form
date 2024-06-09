<?php
include "./conn.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$record_add_error = ''; // Initialize the success message variable
$add_new_item = ''; // Initialize the success message variable
$error_add_new_item = ''; // Initialize the success message variable


// Check if the messages are passed as query parameters
if (isset($_GET['record_add_error'])) {
    $record_add_error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        ' . htmlspecialchars($_GET['record_add_error']) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if (isset($_GET['error_add_new_item'])) {
    $error_add_new_item = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        ' . htmlspecialchars($_GET['error_add_new_item']) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if (isset($_GET['add_new_item'])) {
    $add_new_item = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        ' . htmlspecialchars($_GET['add_new_item']) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop Down From Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #031633;
        }

        .bg_but_colo {
            background-color: #087f5b;
        }

        .bg_box_color {
            background-color: #c3fae8;
        }

        .full-height {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="col-4 mt-3">
            <div class="">
                <?php echo $record_add_error; ?>
                <?php echo $add_new_item; ?>
                <?php echo $error_add_new_item; ?>
            </div>

        </div>
    </div>
    <div class=" d-flex justify-content-center">
        <div class="col-4 mt-5">
            <div class="border border-white rounded-1">
                <h5 class="text-white mt-2 ms-4">Add New Ttem</h5>
                <form method="POST" action="./add_item_run.php">
                    <div class="input-group p-4">
                        <input type="text" class="form-control" name="item_name" placeholder="Add New Item" aria-label="Add New Item" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM item";
    $result = $conn->query($sql);


    // output data of each row
    ?>
    <div class=" d-flex justify-content-center">
        <div class="col-4 mt-5">
            <div class="border border-white rounded-1">
                <h5 class="text-white mt-2 ms-4">Select Ttem</h5>
                <form method="POST" action="./echo.php">
                    <div class="input-group p-4">
                        <select class="form-select" name="item_id" aria-label="Default select example">
                            <option selected>NO Selection</option>
                            <?php if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['item_id'] . " '>" . $row['item_name'] . "</option>";
                                }
                            } else {
                                echo "0 results";
                            } ?>
                        </select>
                         <button class="btn btn-outline-secondary" type="submit" id="button-addon2">VIEW</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

    $conn->close();
    ?>
    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>