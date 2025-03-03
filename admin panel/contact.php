<?php
include '../backend/db_connection.php';  // Include the database connection

// Check if the user is an admin (you can implement your own admin authentication)
// session_start();
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     // Redirect to login page if not logged in as admin
//     header("Location: admin_login.php");
//     exit();
// }

// Fetch contact messages from the database
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";  // Get messages in descending order (most recent first)
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Contact Messages</title>
    <link href="../css/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
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

        .container {
            margin-top: 30px;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table td {
            word-wrap: break-word;
            max-width: 200px;
        }

        .btn-danger {
            color: white;
            background-color: #dc3545;
        }

        .btn-info {
            color: white;
            background-color: #17a2b8;
        }

        .btn-info:hover, .btn-danger:hover {
            opacity: 0.8;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .alert-message {
            background-color: #28a745;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        @media (max-width: 767px) {
            .table th, .table td {
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

<div class="container">
    <h2 class="text-center mb-4">Contact Messages</h2>
    
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="alert-message">You have received new messages!</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <a href="admin_reply.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Reply</a>
                                <a href="admin_delete_message.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="alert alert-warning">No messages found.</p>
    <?php endif; ?>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn);  // Close the database connection
?>