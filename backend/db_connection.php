<?php
// Start the session
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizza_website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    
}

// Optionally, you can set your session variables here if needed
// Example:
// if (isset($_SESSION['user_id'])) {
//     // Your logic here if the session is already set
// }


//

// Step 6: Close the database connection
