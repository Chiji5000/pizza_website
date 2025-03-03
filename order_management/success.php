<?php
// Include database connection
include '../backend/db_connection.php';

// Check if order_id is set in the URL
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("Order ID is missing. Please contact support.");
}

// Get the order ID from the URL
$order_id = $_GET['order_id'];

// Query to fetch order details, specifying each table we are retrieving data from
$query = "
    SELECT 
        o.order_id, 
        o.status, 
        o.created_at, 
        u.username, 
        oi.product_id, 
        p.name AS product_name, 
        oi.quantity, 
        oi.price
    FROM orders o
    INNER JOIN users u ON o.user_id = u.user_id   -- Getting the user information from the 'users' table
    INNER JOIN order_items oi ON o.order_id = oi.order_id  -- Getting the order items from the 'order_items' table
    INNER JOIN products p ON oi.product_id = p.product_id  -- Getting product details from the 'products' table
    WHERE o.order_id = ?
";

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);  // Binding the 'order_id' parameter to the query
$stmt->execute();
$result = $stmt->get_result();

// Check if the order exists
if ($result->num_rows == 0) {
    die("Order not found.");
}

// Fetch the order details from the query result
$order = $result->fetch_assoc();
?>

<!-- HTML starts here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - Pizza Shop</title>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .order-summary {
            margin-top: 30px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
        }
        .order-summary h2 {
            margin-bottom: 20px;
            color: #28a745;
        }
        .order-details {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        .order-details th, .order-details td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .order-details th {
            background-color: #f4f4f4;
        }
        .order-status {
            margin-top: 20px;
            padding: 15px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }
        .order-status p {
            font-size: 18px;
        }
        .back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Order Confirmation</h1>

        <div class="order-summary">
            <h2>Thank you for your order, <?php echo htmlspecialchars($order['username']); ?>!</h2>
            <p>Your order ID is: <strong><?php echo $order['order_id']; ?></strong></p>
            <p>Order placed on: <strong><?php echo date('F j, Y, g:i a', strtotime($order['created_at'])); ?></strong></p>
            <p>Status: <strong><?php echo ucfirst($order['status']); ?></strong></p>
        </div>

        <div class="order-summary">
            <h3>Order Details</h3>
            <table class="order-details">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    $result->data_seek(0); // Reset the pointer to fetch the order items again
                    while ($item = $result->fetch_assoc()) {
                        $total = $item['quantity'] * $item['price'];
                        $total_price += $total;
                        echo "<tr>
                                <td>{$item['product_name']}</td>
                                <td>{$item['quantity']}</td>
                                <td>$" . number_format($item['price'], 2) . "</td>
                                <td>$" . number_format($total, 2) . "</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="order-status">
            <p><strong>Total Order Price:</strong> $<?php echo number_format($total_price, 2); ?></p>
        </div>

        <a href="../user pages/home.php" class="back-btn">Go to Home</a>
    </div>

</body>
</html>

<?php
// Close the database connection
$stmt->close();
$conn->close();
?>