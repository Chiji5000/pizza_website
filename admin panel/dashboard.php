<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
            color: #333;
            margin: 0;
            min-height: 100vh;
        }

        /* Navbar Styling */
        nav {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px;
            text-align: center;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        nav a:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            transform: scale(1.1);
        }

        .toggle-btn {
            display: none;
            background: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .toggle-btn:hover {
            background: #0056b3;
        }

        /* Hidden Navigation for Toggle */
        .nav-links {
            display: flex;
            flex-wrap: wrap;
        }

        .nav-links.hidden {
            display: none;
        }

        /* Main Container */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 70px);
            padding: 20px;
        }

        /* Dashboard Box */
        .dashboard {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        .dashboard h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .dashboard p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
        }

        /* Dashboard Links */
        .dashboard a {
            display: inline-block;
            padding: 12px 20px;
            margin: 10px 5px;
            background: #007BFF;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .dashboard a:hover {
            background: #0056b3;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .toggle-btn {
                display: block;
            }

            .nav-links {
                flex-direction: column;
                align-items: center;
            }

            .dashboard {
                padding: 15px;
                width: 90%;
            }

            .dashboard a {
                padding: 10px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <button class="toggle-btn" onclick="toggleNav()">Menu</button>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="add_product.php">Add Product</a>
            <a href="manage_products.php">Manage Products</a>
            <a href="logout.php">Logout</a>
            <a href="view_orders.php">View Orders</a>
            <a href="contact.php">User Complaints</a>
        </div>
    </nav>

    <div class="container">
        <div class="dashboard">
            <h2>Welcome, Admin!</h2>
            <p>You can manage products, view orders, and more from here.</p>
            <a href="admin_insert_form.php">Add More Admin</a>
            <a href="manage_products.php">Manage Products</a>
        </div>
    </div>

    <script>
        function toggleNav() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('hidden');
        }
    </script>
</body>
</html>