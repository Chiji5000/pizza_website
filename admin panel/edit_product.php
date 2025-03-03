<?php
include ( '../backend/db_connection.php');

// Check if the admin is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: admin_login.php");
    exit;
}

// Get product id from the URL
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $category = trim($_POST['category']);
    $image = $_FILES['image']['name'];

    if ($image) {
        // Upload image
        $target_dir = "uploads";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $query = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, category = ?, image = ? WHERE product_id = ?");
        $query->bind_param("ssdssi", $product_name, $description, $price, $category, $image, $product_id);
    } else {
        $query = $conn->prepare("UPDATE products SET product_name = ?, description = ?, price = ?, category = ? WHERE product_id = ?");
        $query->bind_param("ssdsi", $product_name, $description, $price, $category, $product_id);
    }

    if ($query->execute()) {
        $success = "Product updated successfully!";
    } else {
        $error = "Error updating product.";
    }
}

// Fetch product data
$query = $conn->prepare("SELECT product_id, name, description, price ,image, category, created_at  FROM products WHERE product_id = ?");
$query->bind_param("i", $product_id);
$query->execute();
$product = $query->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
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
            transform: scale(1.05);
        }

        /* Main Container Styling */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            min-height: 80vh;
        }

        /* Form Container Styling */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 20px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form Elements Styling */
        .form-container input, 
        .form-container textarea, 
        .form-container select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }

        /* File Upload Styling */
        .form-container input[type="file"] {
            padding: 5px;
            font-size: 14px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .form-container button:hover {
            background: #0056b3;
        }

        /* Success/Error Messages Styling */
        .error, .success {
            text-align: center;
            font-size: 14px;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        /* Responsive Adjustments */
        @media screen and (max-width: 768px) {
            .form-container {
                padding: 20px;
                width: 90%;
            }

            nav a {
                font-size: 14px;
                padding: 8px 16px;
            }

            .form-container input, 
            .form-container textarea, 
            .form-container select, 
            .form-container button {
                font-size: 14px;
            }
        }

        @media screen and (max-width: 576px) {
            .form-container {
                width: 100%;
            }

            .form-container h2 {
                font-size: 20px;
            }

            nav {
                flex-direction: column;
                align-items: center;
            }

            nav a {
                margin: 8px 0;
                padding: 10px;
                font-size: 14px;
            }

            .form-container input, 
            .form-container textarea, 
            .form-container select {
                font-size: 14px;
            }

            .form-container button {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_product.php">Add Product</a>
        <a href="manage_products.php">Manage Products</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <div class="form-container">
            <h2>Edit Product</h2>

            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
            
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" placeholder="Product Name" required>
                <textarea name="description" placeholder="Product Description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" placeholder="Price" required>
                <select name="category" required>
                    <option value="Italy" <?php echo ($product['category'] == 'Italy') ? 'selected' : ''; ?>>Italy</option>
                    <option value="USA" <?php echo ($product['category'] == 'USA') ? 'selected' : ''; ?>>USA</option>
                    <option value="France" <?php echo ($product['category'] == 'France') ? 'selected' : ''; ?>>France</option>
                    <option value="Mexico" <?php echo ($product['category'] == 'Mexico') ? 'selected' : ''; ?>>Mexico</option>
                    <option value="Japan" <?php echo ($product['category'] == 'Japan') ? 'selected' : ''; ?>>Japan</option>
                </select>
                <input type="file" name="image">
                <button type="submit">Update Product</button>
            </form>
        </div>
    </div>
</body>
</html>