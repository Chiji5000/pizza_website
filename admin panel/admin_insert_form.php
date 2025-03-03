<?php

include '../backend/db_connection.php';

// Check if the current user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Only admins can add other admins.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'admin'; // Role is hardcoded as 'admin'

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query with placeholders
    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Admin added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <style>
        /* Styles remain the same */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
            box-sizing: border-box;
        }

        .form-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container input {
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-container button {
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .form-container .error {
            color: red;
            margin-bottom: 10px;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .form-container h1 {
                font-size: 20px;
            }

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
    <div class="form-container">
        <h1>Add Admin</h1>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Add Admin</button>
        </form>
    </div>
</body>
</html>