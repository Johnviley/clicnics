<?php
// Import database connection
include("../connection.php");

if ($_POST) {
    $invid = $_POST['invid'];
    $quantity = $_POST['quantity'];

    // Update only the quantity in the inventory table
    $query = "UPDATE inventory SET quantity = ? WHERE invid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $quantity, $invid);

    if ($stmt->execute()) {
        echo "Quantity updated successfully.";
    } else {
        echo "Error updating quantity: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
