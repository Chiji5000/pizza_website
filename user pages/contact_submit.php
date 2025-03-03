<?php
include '../backend/db_connection.php';  // Ensure this includes your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Prepare SQL query to insert the data into the table
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
        
        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // If successful, redirect to a thank you page or show a success message
            echo "<script>alert('Thank you for reaching out! We will get back to you soon.'); window.location.href = 'contact.php';</script>";
        } else {
            // If there's an error, display the error message
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href = 'contact.php';</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.'); window.location.href = 'contact.php';</script>";
    }
}
?>