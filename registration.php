<?php
// Start session
session_start();

// Include database connection
include 'db_connection.php'; // Ensure this file contains the `$conn` connection variable

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
        // Set a session message for successful registration
        $_SESSION['success_message'] = 'Registration successful! Your application is undergoing approval.';
        // Redirect to the same page to avoid resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Set a session message for an error
        $_SESSION['error_message'] = 'Error: ' . mysqli_error($conn);
    }
}

// Display any success or error messages
$message = '';
if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Clear the message after displaying
} elseif (isset($_SESSION['error_message'])) {
    $message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Clear the message after displaying
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registration</title>
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
            background: linear-gradient(navy, pink);
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
        <h2>Registration Form</h2>
        <?php if ($message): ?>
            <div class="notification">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- Form fields (same as your HTML form structure) -->
            <label for="institutionType">Type of Institution:</label>
            <select id="institutionType" name="institutionType" required>
                <option value="Tertiary Institution">Tertiary Institution</option>
                <option value="High School">High School</option>
            </select>

            <label for="affiliation">Affiliation:</label>
            <input type="text" id="affiliation" name="affiliation" required>

            <label for="pastParticipation">Participation in past NUST programming competition:</label>
            <input type="radio" id="yes" name="pastParticipation" value="Yes" required>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="pastParticipation" value="No" required>
            <label for="no">No</label>

            <label for="preferredLanguage">Preferred Programming Language:</label>
            <select id="preferredLanguage" name="preferredLanguage" required>
                <option value="Java">Java</option>
                <option value="Python">Python</option>
                <option value="Visual Basic">Visual Basic</option>
                <option value="JavaScript">JavaScript</option>
                <option value="PHP">PHP</option>
                <option value="C#">C#</option>
            </select>

            <label for="ide">Preferred IDE/Text Editor:</label>
            <input type="text" id="ide" name="ide" required>

            <label for="name">TeamName:</label>
            <input type="text" id="name" name="name" required>

            <label for="surname">Surname:</label>
            <input type="text" id="surname" name="surname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="contactNumber">Contact Phone Number:</label>
            <input type="tel" id="contactNumber" name="contactNumber" required>

            <h3>Mentor Details</h3>
            <label for="mentorName">Mentor Name:</label>
            <input type="text" id="mentorName" name="mentorName" required>

            <label for="mentorEmail">Mentor Email:</label>
            <input type="email" id="mentorEmail" name="mentorEmail" required>

            <label for="mentorContact">Mentor Contact Number:</label>
            <input type="tel" id="mentorContact" name="mentorContact" required>

            <label>
                <input type="checkbox" required>
                I acknowledge that I have understood the rules of the competition.
            </label>

            <button type="submit">Submit Registration</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 NUST Annual Programming Competition</p>
    </footer>
</body>
</html>
