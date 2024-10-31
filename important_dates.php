<?php
// Start session and check if admin is logged in

// Include database connection
include 'db_connection.php';

$important_dates = mysqli_query($conn, "SELECT * FROM important_dates");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Important Dates</title>
</head>
<body>
    <header>
        <h1>NUST Annual Programming Competition</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="registration.php">Register</a></li>
                <li><a href="important_dates.php">Important Dates</a></li>
                <li><a href="sponsors.php">Sponsors</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="contact.php">Contact</a></li>
                
            </ul>
        </nav>
    </header>
    <main>
    <h2>Important Dates</h2>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($important_dates)) : ?>
                <li>
                    <?php echo htmlspecialchars($row['event_name']); ?> - <?php echo htmlspecialchars($row['event_date']); ?>
                </li>
            <?php endwhile; ?>
        </ul>

    </main>
    <footer>
        <p>&copy; 2024 NUST Annual Programming Competition</p>
    </footer>
</body>
</html>