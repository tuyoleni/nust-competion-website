<?php
session_start();
include 'db_connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the given username exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the user data

        // Verify the entered password against the hashed password in the database
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['admin_logged_in'] = true; // Set session variable
            $_SESSION['admin_username'] = $username; // Store username in session
            header('Location: admin_dashboard.php'); // Redirect to admin dashboard
            exit();
        } else {
            // Password is incorrect
            echo "Invalid password. Please try again.";
        }
    } else {
        // No user found with that username
        echo "No user found with that username. Please check your input.";
    }

    $stmt->close();
}
?>