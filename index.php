<?php
// Include database connection
include 'db_connection.php';

// Fetch gallery, important dates, and sponsors
$gallery = mysqli_query($conn, "SELECT * FROM gallery");
$important_dates = mysqli_query($conn, "SELECT * FROM important_dates");
$sponsors = mysqli_query($conn, "SELECT * FROM sponsors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>NUST Annual Programming Competition</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 20px;
            background
        }
        h1 {
            color: #2c3e50;
        }
        h2 {
            color: #2980b9;
        }
        h3 {
            color: #27ae60;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        p {
            margin-bottom: 15px;
        }
        footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #7f8c8d;
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
    <h1>Join the 2024 Programming Competition!</h1>

<p>The <strong>Faculty of Computing and Informatics</strong> at <strong>NUST</strong> is excited to announce the annual programming competition for 2024! We invite all aspiring programmers from Namibian high schools and tertiary institutions to register and showcase their skills.</p>

<h2>Participation Requirements</h2>

<h3>For High School Category:</h3>
<ul>
    <li><strong>Date & Time:</strong> Mandatory physical presence on the NUST main campus by <strong>7:30 AM</strong> on <strong>Saturday, 2nd November 2024</strong>.</li>
    <li><strong>Team Equipment:</strong> At least <strong>one laptop</strong> per team.</li>
    <li><strong>Programming Language:</strong> Choose your preferred language (e.g., <strong>Python, Visual Basic, Java, C#, etc.</strong>).</li>
</ul>

<h3>For Tertiary Category:</h3>
<ul>
    <li><strong>Internet Connection:</strong> A stable internet connection is required.</li>
    <li><strong>Device:</strong> Laptop or desktop computer.</li>
    <li><strong>Programming Language:</strong> Choose your preferred language (e.g., <strong>Python, Visual Basic, Java, C#, etc.</strong>).</li>
    <li><strong>Development Tools:</strong> A suitable IDE or development tool.</li>
</ul>

<h2>Competition Rules</h2>
<ul>
    <li><strong>Team Participation:</strong> Participation is <strong>only through groups</strong>. Teams must consist of <strong>3 to 6 members</strong> (friends/classmates).</li>
    <li><strong>High School Teams:</strong> The competition will take place on the NUST campus, and all participating teams must be physically present on <strong>Saturday, 2nd November 2024</strong>.</li>
    <li><strong>Tertiary Teams:</strong> The competition will be conducted in <strong>hybrid mode</strong>; physical presence on campus is <strong>not mandatory</strong>.</li>
    <li><strong>Team Composition:</strong> All team members must be from the same high school or institution of higher learning/university.</li>
    <li><strong>Agreement to Participate:</strong> All participants must agree to compete and understand that they can withdraw from the competition at any time.</li>
    <li><strong>Team Changes:</strong> No additions may be made to teams after the entry has been submitted.</li>
</ul>

<p>We look forward to seeing your creativity and skills in action! Prepare your teams, choose your programming languages, and get ready for an exciting competition!</p>

  
       
    </main>
    <footer>
        <p>&copy; 2024 NUST Annual Programming Competition</p>
    </footer>
</body>
</html>