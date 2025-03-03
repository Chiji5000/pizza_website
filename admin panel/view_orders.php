<?php
include('../backend/db_connection.php');

// Retrieve filter if set
$status = isset($_GET['status']) ? $_GET['status'] : "";

// SQL query to fetch orders
$sql = "
    SELECT 
        o.order_id, 
        u.username, 
        p.name AS product_name, 
        oi.quantity, 
        (oi.quantity * oi.price) AS total_price, 
        o.status, 
        o.created_at
    FROM orders o
    INNER JOIN users u ON o.user_id = u.user_id
    INNER JOIN order_items oi ON o.order_id = oi.order_id
    INNER JOIN products p ON oi.product_id = p.product_id";

if ($status) {
    $sql .= " WHERE o.status = ?";
}

$sql .= " ORDER BY o.created_at DESC";

$stmt = $conn->prepare($sql);
if ($status) {
    $stmt->bind_param("s", $status);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Orders</title>
    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
            background: #f7f9fc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        select, button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .filter {
            background-color: #1E3A8A;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .filter:hover {
            background-color: #155FA0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #3B82F6;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f7f9fc;
        }
        tr:hover {
            background-color: #eef5ff;
        }
        /* Confirm button styling */
        .confirm-btn {
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .confirm-btn:hover {
            background-color: #45a049;
        }
        /* Notification Styles */
        .notification {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
        .notification.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .notification.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        /* Responsive Styles */
        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }
            form {
                flex-direction: column;
                align-items: center;
            }
            .confirm-btn {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: red;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        .back-button:hover {
            background-color: #155FA0;
        }
    </style>
        <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>

<body>
<button class="back-button" onclick="goBack()">Go Back</button>
    <div class="container">
        <h1>Admin - View Orders</h1>

        <!-- Display success or error message -->
        <?php
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
            $type = (isset($_GET['type']) && $_GET['type'] == 'error') ? 'error' : 'success';
            echo "<div class='notification $type'>$message</div>";
        }
        ?>

        <!-- Filter Form -->
        <form method="GET" action="">
            <label for="status">Filter by Order Status:</label>
            <select name="status" id="status">
                <option value="">All</option>
                <option value="pending" <?php echo $status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="completed" <?php echo $status == 'completed' ? 'selected' : ''; ?>>Completed</option>
                <option value="cancelled" <?php echo $status == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
            </select>
            <button class="filter" type="submit">Filter</button>
        </form>

        <!-- Orders Table -->
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['order_id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['product_name']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['total_price']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['created_at']}</td>
                                <td>
                                    <!-- Confirm Button Form -->
                                    <form method='POST' action='confirm.php'>
                                        <input type='hidden' name='order_id' value='{$row['order_id']}'>
                                        <button type='submit' class='confirm-btn'>Confirm</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>