
<?php
// Start session and check if admin is logged in
session_start();

// Include database connection
include 'db_connection.php';


// Fetch gallery
$gallery = mysqli_query($conn, "SELECT * FROM gallery");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Gallery</title>
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
    <h2>Gallery</h2>
<ul>
    <?php while ($row = mysqli_fetch_assoc($gallery)) : ?>
       <p>
            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['description']); ?>" width="250">
            <p><?php echo htmlspecialchars($row['description']); ?></p>
            <a href="<?php echo htmlspecialchars($row['image_url']); ?>" target="_blank">View Full Image</a>
            </p>
    <?php endwhile; ?>
</ul>
    </main>
    <footer>
        <p>&copy; 2024 NUST Annual Programming Competition</p>
    </footer>
</body>
</html>