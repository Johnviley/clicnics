<?php

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
    header("location: ../login.php");
    exit();
}

if ($_POST) {
    include("../connection.php");

    $name = $_POST["name"];
    $quantity = intval($_POST["quantity"]);
    $category = $_POST["category"];
    $expdate = $_POST["expdate"];
    $date = date("Y-m-d"); // Store the current date

    // Check if the medicine already exists in the inventory
    $check_sql = "SELECT * FROM inventory WHERE name = '$name' AND category = '$category'";

    $check_result = $database->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Medicine exists, update quantity
        $row = $check_result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;
        $new_expdate = $row['expdate'];

        $update_sql = "UPDATE inventory SET quantity = '$new_quantity', expdate = '$expdate', date = '$date' WHERE name = '$name' AND category = '$category'";
        $database->query($update_sql);

        // Store the history of added quantity
        $history_sql = "INSERT INTO history (name, quantity, category, expdate, date) VALUES ('$name', '$quantity', '$category', '$expdate', '$date')";
        $database->query($history_sql);

        $record_sql = "INSERT INTO record (name, quantity, category, expdate, date) VALUES ('$name', '$quantity', '$category', '$expdate',  '$date')";
        $database->query($record_sql);
        
    } else {
        // Medicine does not exist, insert new record
        $insert_sql = "INSERT INTO inventory (name, quantity, category, expdate, date) VALUES ('$name', '$quantity', '$category', '$expdate','$date')";
        $database->query($insert_sql);

        // Store the history of added quantity
        $history_sql = "INSERT INTO history (name, quantity, category, expdate, date) VALUES ('$name', '$quantity', '$category', '$expdate', '$date')";
        $database->query($history_sql);

        $record_sql = "INSERT INTO record (name, quantity, category, expdate, date) VALUES ('$name', '$quantity', '$category', '$expdate',  '$date')";
        $database->query($record_sql);
    }

    header("location: inventory.php?action=item-added&title=$name");
    exit();
}

?>
