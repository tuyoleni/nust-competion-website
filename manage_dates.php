<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $description = $_POST['description'];

    $query = "INSERT INTO important_dates (event_name, event_date, description) VALUES ('$event_name', '$event_date', '$description')";
    mysqli_query($conn, $query);

    header('Location: admin_dashboard.php');
    exit();
}