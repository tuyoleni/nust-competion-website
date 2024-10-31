<?php
// Start session and check if admin is logged in
session_start();

// Include database connection
include 'db_connection.php';


// Fetch sponsors

$sponsors = mysqli_query($conn, "SELECT * FROM sponsors");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sponsors</title>
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
    <h2>Sponsors</h2>
<ul>
    <?php while ($row = mysqli_fetch_assoc($sponsors)) : ?>
       
           <ul><img src="<?php echo htmlspecialchars($row['logo_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" width="100">
            <h3>
               
                    <?php echo htmlspecialchars($row['name']); ?>
        
            </h3>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
            </ul>
    <?php endwhile; ?>
</ul>
</ul>
    </main>
    <footer>
        <p>&copy; 2024 NUST Annual Programming Competition</p>
    </footer>
</body>
</html>