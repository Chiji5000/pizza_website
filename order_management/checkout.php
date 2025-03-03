<?php
// Include database connection
include '../backend/db_connection.php';


// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in to proceed to checkout.");
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Fetch cart data from session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Your cart is empty. Please add items to proceed.");
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'];

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Pizza Shop</title>
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
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            border-radius: 5px;
        }
        .cart-item-details {
            flex: 1;
            margin-left: 15px;
        }
        .cart-item-details h4 {
            margin: 0;
        }
        .cart-item-price {
            font-weight: bold;
            color: #ff4500;
        }
        .total-section {
            text-align: right;
            font-size: 1.2rem;
            margin-top: 20px;
        }
        .btn-checkout {
            display: block;
            margin: 20px auto;
            background-color: #28a745;
            color: white;
            padding: 15px 30px;
            text-align: center;
            font-size: 1.2rem;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-checkout:hover {
            background-color: #218838;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
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

    <!-- Checkout Section -->
    <div class="container">
        <h2>Checkout</h2>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <div class="cart-item">
                <img src="../admin panel/uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                <div class="cart-item-details">
                    <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                </div>
                <div class="cart-item-price">$<?php echo number_format($item['price'], 2); ?></div>
            </div>
        <?php endforeach; ?>
        <div class="total-section">
            <p>Total: <strong>$<?php echo number_format($total_price, 2); ?></strong></p>
        </div>
        <form action="process_checkout.php" method="POST">
            <button type="submit" class="btn-checkout">Confirm and Pay</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Pizza Shop. All Rights Reserved.</p>
    </footer>
</body>
</html>