<?php
include ( '../backend/db_connection.php')
;
include 'nav.php';

// Check if the category is provided in the URL
if (!isset($_GET['category']) || empty($_GET['category'])) {
    header('Location: menu.php'); // Redirect to the main menu if no category is provided
    exit();
}

$category = $conn->real_escape_string($_GET['category']); // Sanitize input

// Fetch products in the selected category
$query = "SELECT * FROM products WHERE category = '$category'";
$result = $conn->query($query);

// Check for errors
if (!$result) {
    die("Error fetching products: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - <?php echo htmlspecialchars($category); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Navbar */
        nav {
            background-color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            position: relative;
            width: 100%;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .nav-brand img {
            height: 40px;
            width: 40px;
            object-fit: cover;
            border-radius: 50%;
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

        /* Mobile Menu Styles */
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
                padding: 10px 0;
                z-index: 999;
            }

            .nav-links.active {
                display: flex;
            }
        }

        /* Content Styling */
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .product-card {
            display: inline-block;
            background: white;
            margin: 15px;
            padding: 15px;
            width: 280px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            max-width: 100%;
            height: 200px;
            border-radius: 8px;
        }

        .product-card h3 {
            font-size: 1.2rem;
            margin: 10px 0;
            color: #333;
        }

        .product-card p {
            color: #555;
            font-size: 1rem;
            margin: 5px 0;
        }

        .product-card button {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .product-card button:hover {
            background-color: #0056b3;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
            bottom: 0;
            width: 100%;
        }

        /* Responsive Grid */
        @media (max-width: 768px) {
            .product-card {
                width: 100%;
                margin: 10px 0;
            }

            .container {
                padding: 10px;
            }

            .nav-links {
                flex-direction: column;
            }
        }

        @media (min-width: 769px) {
            .product-card {
                width: 30%;
            }
        }

    </style>
</head>
<body>


    <!-- Category Products Section -->
    <div class="container">
        <h2>Menu - <?php echo htmlspecialchars($category); ?></h2>
        <div class="product-grid">
            <?php if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) { ?>
                    <div class="product-card">
                        <img src="../admin panel/uploads/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p><strong>$<?php echo number_format($product['price'], 2); ?></strong></p>

                        <a href="../order_management/cart.php?add=<?php echo $product['product_id']; ?>" class="btn-primary"><button type="submit" >Add to Cart</button></a>
                        
                        <!-- <form method="POST" action="../order_management/cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <a href="../order_management/cart.php?add=<?php echo $product['product_id']; ?>"> <button type="submit">Add to Cart</button></a>
                        </form> -->
                    </div>
                <?php }
            } else { ?>
                <p>No products found in this category.</p>
            <?php } ?>
        </div>
    </div>


</body>
</html>
<?php
include 'footer.php';
?>
