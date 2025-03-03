<?php
// Include database connection
include '../backend/db_connection.php';


// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must log in to complete your purchase.");
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Check if the cart exists and is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Your cart is empty. Please add items to proceed.");
}

// Start transaction to ensure atomicity
$conn->begin_transaction();

try {
    // Insert the order into the `orders` table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, status, created_at) VALUES (?, ?, ?, NOW())");
    $total_price = array_sum(array_column($_SESSION['cart'], 'price'));
    $status = 'pending'; // Default status
    $stmt->bind_param("ids", $user_id, $total_price, $status);
    $stmt->execute();

    // Get the generated order ID
    $order_id = $conn->insert_id;

    // Insert each item into the `order_items` table
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['product_id'];
        $quantity = 1; // Default to 1 if no quantity tracking
        $price = $item['price'];
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
    }

    // Commit the transaction
    $conn->commit();

    // Clear the cart session
    unset($_SESSION['cart']);

    // Redirect to a success page
    header("Location: success.php?order_id=" .$order_id);
    exit;
} catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    die("An error occurred while processing your order. Please try again.");
} finally {
    $stmt->close();
    $conn->close();
}
?>