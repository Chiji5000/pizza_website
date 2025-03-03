<?php
include ( '../backend/db_connection.php');

// Redirect to home if the user is logged in
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Pizza Shop</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        nav {
            background-color: #333;
            padding: 1rem;
            text-align: center;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 15px;
            font-size: 18px;
        }
        nav a:hover {
            background-color: #575757;
            border-radius: 5px;
        }
        .hero {
            height: 100vh;
            background-image: url('images/pizza-hero.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }
        .hero h1 {
            font-size: 4rem;
        }
        .hero p {
            font-size: 1.5rem;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons a {
            background-color: #ff4500;
            color: white;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 10px;
        }
        .buttons a:hover {
            background-color: #e03e00;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
           position: fixed ;
           bottom: 0;
           width: 100%;
           z-index: 1000;
        }
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>

    <a href="home.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <a href="menu.php">Menu</a>
        <a href="../authentication/logout.php">Logout</a>
    
        <a href="../authentication/register.php">Register</a>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Welcome to Our Pizza Shop</h1>
            <p>Delicious pizza delivered right to your door!</p>
            <div class="buttons">
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Pizza Shop | All Rights Reserved</p>
    </footer>
</body>
</html>