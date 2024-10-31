<?php
// Start session
session_start();

// Include database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $institutionType = mysqli_real_escape_string($conn, $_POST['institutionType']);
    $affiliation = mysqli_real_escape_string($conn, $_POST['affiliation']);
    $pastParticipation = mysqli_real_escape_string($conn, $_POST['pastParticipation']);
    $preferredLanguage = mysqli_real_escape_string($conn, $_POST['preferredLanguage']);
    $ide = mysqli_real_escape_string($conn, $_POST['ide']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $mentorName = mysqli_real_escape_string($conn, $_POST['mentorName']);
    $mentorEmail = mysqli_real_escape_string($conn, $_POST['mentorEmail']);
    $mentorContact = mysqli_real_escape_string($conn, $_POST['mentorContact']);

    // Insert data into the database
    $query = "INSERT INTO registrations (institutionType, affiliation, pastParticipation, preferredLanguage, ide, name, surname, email, contactNumber, mentorName, mentorEmail, mentorContact) 
              VALUES ('$institutionType', '$affiliation', '$pastParticipation', '$preferredLanguage', '$ide', '$name', '$surname', '$email', '$contactNumber', '$mentorName', '$mentorEmail', '$mentorContact')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch newly registered members
$query = "SELECT * FROM registrations WHERE status = 'Pending'";
$result = mysqli_query($conn, $query);
?>