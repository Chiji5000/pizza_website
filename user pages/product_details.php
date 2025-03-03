<?php
include ( '../backend/db_connection.php');

// Fetch product details based on ID
$product_id = $_GET['id'];
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = $conn->query($query);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Pizza Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Navbar */
        nav {
            background-color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            position: relative;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .nav-brand h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        .nav-links {
            display: flex;
            gap: 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .nav-links a:hover {
            background-color: #575757;
            border-radius: 5px;
        }

        /* Toggle Button */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle span {
            height: 3px;
            width: 25px;
            background-color: white;
            margin: 5px 0;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                background-color: #333;
                position: absolute;
                top: 100%;
                right: 0;
                width: 100%;
                text-align: center;
                z-index: 999;
            }

            .nav-links.active {
                display: flex;
            }
        }

        /* Product Details Section */
        .product-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .product-details img {
            width: 350px;
            height: 350px;
            object-fit: cover;
            border-radius: 8px;
            margin: 20px;
        }

        .product-info {
            max-width: 500px;
            text-align: left;
            margin: 20px;
        }

        .product-info h2 {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .product-info p {
            font-size: 1.2rem;
            color: #555;
        }

        .price {
            font-size: 1.5rem;
            color: #ff4500;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #ff4500;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1.2rem;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #e03e00;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .product-details {
                flex-direction: column;
                align-items: center;
            }

            .product-info {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="nav-brand">
            <h1>Pizza Shop</h1>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="nav-links">
            <a href="home.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
            <a href="menu.php">Menu</a>
            <a href="../authentication/logout.php">Logout</a>
        </div>
    </nav>

    <!-- Product Details Section -->
    <div class="product-details">
        <img src="../admin panel/uploads/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <div class="product-info">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
            <a href="../order_management/cart.php?add=<?php echo $product['product_id']; ?>" class="btn-primary">Add to Cart</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Pizza Shop | All Rights Reserved</p>
    </footer>

    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
</body>
</html>
