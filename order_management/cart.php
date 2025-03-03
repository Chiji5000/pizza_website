<?php
// Include database connection
include '../backend/db_connection.php';




// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add items to the cart
if (isset($_GET['add'])) {
    $product_id = intval($_GET['add']);
    $query = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $_SESSION['cart'][$product_id] = $product;
    }
}

// Remove items from the cart
if (isset($_GET['remove'])) {
    $product_id = intval($_GET['remove']);
    unset($_SESSION['cart'][$product_id]);
}

// Calculate total price
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Pizza Shop</title>
    <style>
        /* Add your styling here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
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
            padding: 10px;
            font-size: 18px;
        }
        .cart-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .cart-item-info {
            flex: 1;
            margin-left: 15px;
        }
        .cart-total {
            text-align: right;
            font-size: 1.5rem;
            margin-top: 20px;
        }
        .btn-remove {
            background-color: #ff4500;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
        }
        .btn-remove:hover {
            background-color: #e03e00;
        }
        .checkout-btn {
            background-color: #28a745;
            color: white;
            padding: 15px;
            text-decoration: none;
            font-size: 1.2rem;
            border-radius: 5px;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <a href="../user pages/home.php">Home</a>
        <a href="../user pages/about.php">About Us</a>
        <a href="../user pages/contact.php">Contact Us</a>
        <a href="../user pages/menu.php">Menu</a>
        <a href="../authentication/logout.php">Logout</a>
    </nav>

    <!-- Cart Section -->
    <div class="cart-container">
        <h2>Your Cart</h2>

        <?php if (empty($_SESSION['cart'])) { ?>
            <p>Your cart is empty. <a href="../user pages/menu.php">Browse our menu</a> and add items to your cart.</p>
        <?php } else { ?>
            <?php foreach ($_SESSION['cart'] as $item) { ?>
                <div class="cart-item">
                    <img src="../admin panel/uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <div class="cart-item-info">
                        <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                        <p><?php echo htmlspecialchars($item['description']); ?></p>
                        <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                    </div>
                    <a href="cart.php?remove=<?php echo $item['product_id']; ?>" class="btn-remove">Remove</a>
                </div>
            <?php } ?>

            <div class="cart-total">
                <p>Total: $<?php echo number_format($total, 2); ?></p>
                <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
            </div>
        <?php } ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Pizza Shop | All Rights Reserved</p>
    </footer>
</body>
</html>