<?php
include '../backend/db_connection.php';
include 'nav.php';

// Fetch categories
$query = "SELECT DISTINCT category FROM products";
$categories = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Pizza Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

      
        /* Category Section */
        .category-container {
            padding: 20px;
            text-align: center;
        }

        .category-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .category-btn {
            background-color: #ff4500;
            color: white;
            padding: 15px 25px;
            font-size: 1.2rem;
            margin: 10px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .category-btn:hover {
            background-color: #e03e00;
        }

        .order{
            color: blue;
            padding: 10px;
         font-size: 30px;
         text-decoration: underline ;

        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
        }

        /* Responsive Category Buttons */
        @media (max-width: 768px) {
            .category-btn {
                width: 90%;
                font-size: 1rem;
                padding: 10px 20px;
            }

            .category-container {
                padding: 10px;
            }
        }

      
    </style>
</head>
<body>


    <!-- Category Section -->
    <div class="category-container">
        <h2>Browse Our Pizza Categories</h2>
        <?php while ($category = $categories->fetch_assoc()) { ?>
            <a href="menu_category.php?category=<?php echo $category['category']; ?>" class="category-btn">
                <?php echo ucfirst($category['category']); ?>
            </a>
        <?php } ?>

       <a href="../order_management/order_history.php"><div class="order">Your order history</div></a> 
    </div>

 

    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
</body>
</html>
<?php
include 'footer.php';
?>
