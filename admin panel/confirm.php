<?php
include('../backend/db_connection.php');

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the order ID from the form
    $order_id = $_POST['order_id'];

    // Prepare SQL to update the status of the specific order to 'completed'
    $sql = "UPDATE orders SET status = 'completed' WHERE order_id = ? AND status = 'pending'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    // Execute the query and check if successful
    if ($stmt->execute()) {
        header("Location: view_orders.php?message=Order $order_id confirmed successfully.&type=success");
    } else {
        header("Location: view_orders.php?message=Error confirming order $order_id.&type=error");
    }

    $stmt->close();
}

$conn->close();
?>