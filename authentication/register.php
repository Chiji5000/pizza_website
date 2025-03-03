<?php
include ( '../backend/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $query->bind_param("sss", $username, $email, $password);

    if ($query->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Email already exists.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-image: url('../image/Wooden.jpg') ;
            background-size: cover;
        }
        .register-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .register-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .register-container input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .register-container button {
            width:100% ;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .register-container button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
        }
        @media (max-width: 768px) {
            .register-container {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p style="text-align: center; margin-top: 10px;">
            Already have an account? <a href="login.php">Login</a>
        </p>
    </div>
</body>
</html>
