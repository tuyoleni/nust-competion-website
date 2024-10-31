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
    <style>
        

        header {
            text-align: center;
            padding: 20px 0;
            color: white;
            position: relative;
            z-index: 1;
        }

        header h1 {
            font-family: "Open Sans", sans-serif;
            font-size: 2.5em;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        nav {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px 0;
            position: relative;
            z-index: 1;
        }

        nav ul {
            text-align: center;
            background: linear-gradient(pink, navy);
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1), inset 0 0 1px rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            transition: background 0.5s ease;
        }

        nav ul li {
            display: inline-block;
        }

        nav ul li a {
            padding: 18px;
            font-family: "Open Sans", sans-serif;
            text-transform: uppercase;
            color: white;
            font-size: 18px;
            text-decoration: none;
            display: block;
            transition: color 0.3s ease, background 0.3s ease;
        }

        nav ul li a:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), inset 0 0 1px rgba(255, 255, 255, 0.6);
            background: rgba(255, 255, 255, 0.1);
            color: rgba(0, 35, 122, 0.7);
        }
    </style>
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