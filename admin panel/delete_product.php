<?php
include('../backend/db_connection.php');


// Check if the admin is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: admin_login.php");
    exit;
}

// Check if product ID is provided
if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']); // Convert to integer for safety

    // Prepare and execute the deletion query
    $query = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    if ($query) {
        $query->bind_param("i", $product_id);

        if ($query->execute()) {
            // Redirect with success message
            header("Location: manage_products.php?message=Product deleted successfully.");
            exit;
        } else {
            // Redirect with database error message
            header("Location: manage_products.php?message=Error deleting product: " . $conn->error);
            exit;
        }
    } else {
        // Redirect with query preparation error message
        header("Location: manage_products.php?message=Error preparing delete query: " . $conn->error);
        exit;
    }
} else {
    // Redirect if product ID is not provided or invalid
    header("Location: manage_products.php?message=Invalid product ID.");
    exit;
}
?>