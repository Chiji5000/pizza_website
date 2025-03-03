<?php
include ( '../backend/db_connection.php');

// Check if the admin is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: admin_login.php");
    exit;
}

// Fetch all products
$query = "SELECT * FROM products";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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

        /* Navbar Styling */
        nav {
            background: #333;
            color: white;
            padding: 15px;
            text-align: center;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            margin: 5px;
            transition: all 0.3s ease-in-out;
        }

        nav a:hover {
            background: #575757;
            border-radius: 4px;
            transform: scale(1.1);
        }

        /* Container Styling */
        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        /* Product Table Styling */
        .product-table {
            width: 100%;
            max-width: 1200px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .product-table h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
            text-transform: uppercase;
        }

        td img {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        td img:hover {
            transform: scale(1.2);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        /* Action Buttons */
        .actions a, 
        .actions button {
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            color: white;
            margin-right: 5px;
            transition: all 0.3s ease-in-out;
        }

        .actions a {
            background-color: #007BFF;
        }

        .actions a:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        .delete-btn {
            background-color: red;
            border: none;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: darkred;
            transform: translateY(-3px);
        }

        /* Responsive Adjustments */
        @media screen and (max-width: 768px) {
            .product-table h2 {
                font-size: 20px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }

            td img {
                width: 40px;
                height: 40px;
            }
        }

        @media screen and (max-width: 576px) {
            th, td {
                display: block;
                text-align: right;
                padding: 8px 0;
                position: relative;
            }

            th::before, td::before {
                content: attr(data-label);
                font-weight: bold;
                position: absolute;
                left: 0;
                text-align: left;
                margin-left: 10px;
            }

            td img {
                display: block;
                margin: 5px 0;
            }

            table {
                border: none;
            }
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
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_product.php">Add Product</a>
        <a href="manage_products.php">Manage Products</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <div class="product-table">
            <h2>Manage Products</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $result->fetch_assoc()) { ?>
          <tr>
    <td data-label="Product Name"><?php echo htmlspecialchars($product['name']); ?></td>
    <td data-label="Category"><?php echo htmlspecialchars($product['category']); ?></td>
    <td data-label="Price">$<?php echo number_format($product['price'], 2); ?></td>
    <td data-label="Image">
        <img src="../admin panel/uploads/<?php echo htmlspecialchars($product['image']); ?>" width="50" height="50" alt="Product Image">
    </td>
    <td data-label="Actions" class="actions">
        <a href="edit_product.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="edit-btn">Edit</a>
        <form method="POST" action="delete_product.php" style="display:inline-block;">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
            <button type="submit" class="delete-btn">Delete</button>
        </form>
    </td>
</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>