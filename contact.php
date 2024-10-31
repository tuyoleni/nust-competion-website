<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure to include the Composer autoload file

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Admin email address
    $admin_email = "mosesmwatile6@gmail.com"; 

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'moses.mwatile7@gmail.com';                // SMTP username
        $mail->Password   = 'Mosesmwatile03050800054';                 // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption
        $mail->Port       = 587;                                   // TCP port to connect to

        //Recipients
        $mail->setFrom($email, $name);                            // Sender's email and name
        $mail->addAddress($admin_email);                          // Add a recipient

        // Content
        $mail->isHTML(false);                                     // Set email format to plain text
        $mail->Subject = "New Contact Message from $name";
        $mail->Body    = "You have received a new message from the contact form.\n\n" .
                         "Name: $name\n" .
                         "Email: $email\n" .
                         "Message:\n$message";

        $mail->send();
        $success_message = "Message sent successfully!";
    } catch (Exception $e) {
        $error_message = "Unable to send message. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Contact</title>
</head>
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
            background: linear-gradient(#0366cf, #b10000d3);
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
        <h2>Contact Us</h2>
        <?php if (!empty($success_message)): ?>
            <p style="color: green;"><?php echo $success_message; ?></p>
        <?php elseif (!empty($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="contact.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 NUST Annual Programming Competition</p>
    </footer>
</body>
</html>