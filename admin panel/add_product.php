<?php
include ( '../backend/db_connection.php');

// Check if the admin is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: admin_login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $category = trim($_POST['category']);
    $image = $_FILES['image']['name'];
    
    // Upload image
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $query = $conn->prepare("INSERT INTO products (name, description, price, category, image) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("ssdss", $product_name, $description, $price, $category, $image);

    if ($query->execute()) {
        $success = "Product added successfully!";
    } else {
        $error = "Error adding product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
            align-items: center;
            /* height: calc(100vh - 70px); */
            padding: 20px;
        }

        /* Form Container */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-container input, 
        .form-container textarea, 
        .form-container select, 
        .form-container button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .form-container input:focus, 
        .form-container textarea:focus, 
        .form-container select:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
        }

        .form-container button {
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .form-container button:hover {
            background: #0056b3;
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.1);
        }

        /* Error & Success Messages */
        .error {
            color: red;
            text-align: center;
            margin: 10px 0;
        }

        .success {
            color: green;
            text-align: center;
            margin: 10px 0;
        }

        /* Responsive Adjustments */
        @media screen and (max-width: 768px) {
            nav {
                flex-direction: column;
            }

            nav a {
                margin: 5px 0;
            }

            .form-container {
                padding: 20px;
            }

            .form-container h2 {
                font-size: 20px;
            }

            .form-container input, 
            .form-container textarea, 
            .form-container select, 
            .form-container button {
                font-size: 14px;
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
        <div class="form-container">
            <h2>Add New Product</h2>
            
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
            
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="product_name" placeholder="Product Name" required>
                <textarea name="description" placeholder="Product Description" required></textarea>
                <input type="number" step="0.01" name="price" placeholder="Price" required>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="Italy">Italy</option>
                    <option value="USA">USA</option>
                    <option value="France">France</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Japan">Japan</option>
                </select>
                <input type="file" name="image" required>
                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>
</body>
</html>