<?php
include('../backend/db_connection.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../authentication/login.php");
    exit;
}

// Fetch the latest 10 products
$query = "SELECT * FROM products ORDER BY product_id DESC LIMIT 10";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Pizza Shop</title>
    
    <link rel="stylesheet" type="text/css" href="../css/all.css" />
    <link rel="stylesheet" href="../css/fontawesome.min.css" />

    <link rel="stylesheet" href="../css/css/bootstrap-grid.min.css">
    
    <link href="../css/css/bootstrap.min.css" rel="stylesheet">
  

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            line-height: 1.5;
        }

        /* Navbar */
        nav {
            background-color: #ff5733;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-brand img {
            height: 35px;
            width: 35px;
            object-fit: cover;
            border-radius: 50%;
        }

        .nav-brand h1 {
            color: white;
            font-size: 1.2rem;
            margin: 0;
        }

        .nav-links {
            display: flex;
            gap: 12px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 4px;
        }

        .nav-links a:hover {
            background-color: #c74128;
        }

        .nav-links a.active {
            background-color: #c70039;
        }

        /* Toggle Button */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle span {
            height: 3px;
            width: 20px;
            background-color: white;
            margin: 4px 0;
        }

        /* Mobile Menu */
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                background-color: #ff5733;
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

        .content {
    position: relative;
    height: 730px; /* Further increased height */
    background-image: url('../image/pizza_de.jpg'); /* Replace with your image path */
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0px 0;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 0; /* Removed rounded corners */
}

.content-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Dark overlay for better text visibility */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding: 30px;
    text-align: right;

}

.content-overlay h2 {
    font-size: 2.8rem;
    color: #fff;
    margin-bottom: 15px;
    font-weight: bold;
}

.content-overlay p {
    font-size: 1.2rem;
    color: #ddd;
    margin-bottom: 20px;
    line-height: 1.7;
}

.content-overlay a.button {
    display: inline-block;
    background-color: #ff4500;
    color: white;
    padding: 12px 25px;
    font-size: 1.2rem;
    border-radius: 5px;
    text-decoration: none;
}

.content-overlay a.button:hover {
    background-color: #e03e00;
}

/* Responsive Design */
@media (max-width: 768px) {
    .content {
        height: 350px; /* Adjust height for medium screens */
    }

    .content-overlay {
        text-align: center;
        align-items: center;
        padding: 20px;
    }

    .content-overlay h2 {
        font-size: 2rem;
    }

    .content-overlay p {
        font-size: 1rem;
    }

    .content-overlay a.button {
        padding: 10px 20px;
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .content {
        height: 300px; /* Adjust height for small screens */
    }

    .content-overlay h2 {
        font-size: 1.8rem;
    }

    .content-overlay p {
        font-size: 0.9rem;
    }

    .content-overlay a.button {
        padding: 8px 15px;
        font-size: 0.9rem;
    }
}      .button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #218838;
        }

        /* Product Section */
        .product-container {
            display: grid;
            gap: 15px;
            padding: 15px;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .product-card {
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-card h3 {
            font-size: 1rem;
            color: #333;
            margin: 8px 0;
        }

        .product-card p {
            color: #ff4500;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #ff4500;
            color: white;
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #e03e00;
        }

    


  
  
        .delivery-service {
    position: relative;
    width: 100%;
    height: 100vh;
    background-image: url('../image/dev.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin-bottom:30px ;
}

.delivery-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.delivery-background {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.delivery-text {
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
    color: white;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
      
}

.delivery-text h2 {
    margin-bottom: 20px;
    font-size: 2.5rem;
}

.delivery-text p {
    margin-bottom: 20px;
    font-size: 1.1rem;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ff5733;
    color: white;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #ff3300;
}

/* Large screen styles */
@media screen and (min-width: 1024px) {
    .delivery-text {
        position: absolute;
        right: 20px;
        top: 20%;
        transform: translateY(0);
        text-align: right;
    }
}

/* Small screen styles */
@media screen and (max-width: 1023px) {
    .delivery-text {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
    }
}


footer {
    background-color: #333;
    color: white;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    flex-direction: column;
    gap: 10px;
    padding: 20px 10px;
}

footer .footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

footer p {
    font-size: 0.9rem;
    margin: 0;
}

.footer-icons {
    display: flex;
    gap: 15px;
}

.footer-icons a {
    display: inline-block;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

/* Icon-Specific Styling */
.facebook-icon {
    background-color: #3b5998;
    color: white;
}

/* Icon-Specific Styling */
.facebook-icon {
    background-color: #3b5998;
    color: white;
}

.facebook-icon:hover {
    background-color: #2d4373;
    box-shadow: 0 0 10px 5px rgba(59, 89, 152, 0.7);
}

.twitter-icon {
    background-color: #00acee;
    color: white;
}

.twitter-icon:hover {
    background-color: #0084b4;
    box-shadow: 0 0 10px 5px rgba(0, 172, 238, 0.7);
}

.instagram-icon {
    background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
    color: white;
}

.instagram-icon:hover {
    background: linear-gradient(45deg, #bc1888, #cc2366, #dc2743, #e6683c, #f09433);
    box-shadow: 0 0 10px 5px rgba(188, 24, 136, 0.7);
}
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-brand">
                <img src="logo.pizza.png" alt="Pizza Shop Logo">
                <h1>Pizza Shop</h1>
            </div>
            <div class="menu-toggle" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="nav-links">
                <a href="home.php" class="active">Home</a>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact Us</a>
                <a href="menu.php">Menu</a>
                <a href="../authentication/logout.php">Logout</a>
            </div>
        </nav>
        <div class="content">
    <div class="content-overlay">
        <h2>Freshly Baked, Always Delicious</h2>
        <p>Your favorite pizzas, crafted with love and baked to perfection. Experience the taste of quality in every bite!</p>
        <a href="menu_category.php" class="button">Explore Our Menu</a>
    </div>
</div>
    </header>

    <main>
        <div class="product-container">
            <?php while ($product = $result->fetch_assoc()) { ?>
                <div class="product-card">
                    <img src="../admin panel/uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>$<?php echo number_format($product['price'], 2); ?></p>
                    <a href="product_details.php?id=<?php echo $product['product_id']; ?>" class="btn-primary">View Details</a>
                </div>
            <?php } ?>
        </div>
 <div class="delivery-service">
    <div class="delivery-container">
        <div class="delivery-background">
            <div class="delivery-text">
                <h2>Fast & Reliable Delivery Service</h2>
                <p>
                    Craving pizza but don't want to leave the comfort of your home? We've got you covered! Our delivery service is fast, reliable, and ensures your pizza arrives hot and fresh. Whether you're ordering for yourself or hosting a party, we're here to deliver your favorite pizzas right to your doorstep.
                </p>
                <a href="menu_category.php" class="button">Order Now</a>
            </div>
        </div>
    </div>
</div>
    </main>

    <footer>
    <div class="footer-content">
        <p>&copy; 2024 Pizza Shop | All Rights Reserved</p>
        <div class="footer-icons">
            <a href="#" class="facebook-icon"><i class="fab fa-facebook"></i></a>
            <a href="#" class="twitter-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="instagram-icon"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</footer>

    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
</body>
</html>