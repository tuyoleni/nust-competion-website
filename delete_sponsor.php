<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $query = "DELETE FROM sponsors WHERE id='$id'";
    mysqli_query($conn, $query);

    header('Location: admin_dashboard.php');
    exit();
}