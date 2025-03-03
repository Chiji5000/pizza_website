<?php
// Include database connection
include '../backend/db_connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in to view your order history.");
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Handle order cancellation request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order_id'])) {
    $cancel_order_id = intval($_POST['cancel_order_id']);
    $sql = "UPDATE orders SET status = 'cancelled' WHERE order_id = ? AND user_id = ? AND status = 'pending'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cancel_order_id, $user_id);

    if ($stmt->execute()) {
        $message = "Order #$cancel_order_id has been cancelled.";
    } else {
        $message = "Failed to cancel the order.";
    }
    $stmt->close();
}

// Fetch the user's orders
$sql = "
    SELECT 
        o.order_id, 
        o.total_amount, 
        o.status, 
        o.created_at, 
        oi.product_id, 
        p.name AS product_name, 
        p.image, 
        oi.quantity, 
        oi.price AS item_price 
    FROM orders o
    INNER JOIN order_items oi ON o.order_id = oi.order_id
    INNER JOIN products p ON oi.product_id = p.product_id
    WHERE o.user_id = ?
    ORDER BY o.created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Organize orders with their items
$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[$row['order_id']]['details'] = [
        'order_id' => $row['order_id'],
        'total_price' => $row['total_amount'],
        'status' => $row['status'],
        'created_at' => $row['created_at']
    ];
    $orders[$row['order_id']]['items'][] = [
        'product_name' => $row['product_name'],
        'image' => $row['image'],
        'quantity' => $row['quantity'],
        'item_price' => $row['item_price']
    ];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }
    nav {
        background-color: #333;
        color: white;
        padding: 15px;
        text-align: center;
    }
    nav a {
        color: white;
        text-decoration: none;
        margin: 0 10px;
    }
    nav a:hover {
        text-decoration: underline;
    }
    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .order {
        margin-bottom: 30px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .order-header {
        font-size: 1.2rem;
        margin-bottom: 10px;
        font-weight: bold;
        color: #333;
    }
    .order-items {
        margin-left: 20px;
    }
    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }
    .order-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 5px;
    }
    .order-item-details {
        flex: 1;
        min-width: 150px;
        margin-bottom: 10px;
    }
    .order-item-price {
        color: #ff4500;
        font-weight: bold;
        min-width: 80px;
        text-align: right;
    }
    .cancel-btn {
        margin-left: 10px;
        padding: 5px 10px;
        background-color: #ff4500;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .cancel-btn:hover {
        background-color: #cc3700;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        .order-header {
            font-size: 1rem;
        }
        .order-item img {
            width: 60px;
            height: 60px;
        }
        .order-item-details {
            font-size: 0.9rem;
        }
        .order-item-price {
            font-size: 0.9rem;
        }
        .cancel-btn {
            padding: 5px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        nav {
            padding: 10px;
            font-size: 0.9rem;
        }
        nav a {
            margin: 0 5px;
        }
        .order-header {
            font-size: 0.9rem;
        }
        .order-item img {
            width: 50px;
            height: 50px;
        }
        .order-item-details {
            font-size: 0.8rem;
        }
        .order-item-price {
            font-size: 0.8rem;
        }
        .cancel-btn {
            padding: 5px;
            font-size: 0.8rem;
        }
    }
</style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <a href="../user pages/home.php">Home</a>
        <a href="../user pages/menu.php">Menu</a>
        <a href="../authentication/logout.php">Logout</a>
    </nav>

    <!-- Order History Section -->
    <div class="container">
        <h2>Your Order History</h2>
        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if (empty($orders)) { ?>
            <p>You have not placed any orders yet.</p>
        <?php } else { ?>
            <?php foreach ($orders as $order): ?>
                <div class="order">
                    <div class="order-header">
                        Order ID: <?php echo $order['details']['order_id']; ?> |
                        Total: $<?php echo number_format($order['details']['total_price'], 2); ?> |
                        Status: <?php echo ucfirst($order['details']['status']); ?> |
                        Date: <?php echo $order['details']['created_at']; ?>
                        <?php if ($order['details']['status'] === 'pending'): ?>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="cancel_order_id" value="<?php echo $order['details']['order_id']; ?>">
                                <button type="submit" class="cancel-btn">Cancel Order</button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="order-items">
                        <?php foreach ($order['items'] as $item): ?>
                            <div class="order-item">
                                <img src="../admin panel/uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>">
                                <div class="order-item-details">
                                    <p><?php echo htmlspecialchars($item['product_name']); ?></p>
                                    <p>Quantity: <?php echo $item['quantity']; ?></p>
                                </div>
                                <div class="order-item-price">
                                    $<?php echo number_format($item['item_price'], 2); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } ?>
    </div>
</body>
</html>