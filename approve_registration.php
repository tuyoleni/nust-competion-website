<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.html');
    exit();
}

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $action = $_POST['action'] === 'approve' ? 'Approved' : 'Declined';

    // Fetch user's email and name for the email notification
    $user_query = "SELECT email, name FROM registrations WHERE id = '$id'";
    $user_result = mysqli_query($conn, $user_query);
    $user_data = mysqli_fetch_assoc($user_result);

    if ($user_data) {
        $user_email = $user_data['email'];
        $user_name = $user_data['name'];

        // Email subject and message based on action
        $subject = $action === 'Approved' ? 'Registration Approved' : 'Registration Declined';
        $message = "Dear $user_name,\n\n";
        $message .= $action === 'Approved' 
            ? "Congratulations! Your registration for the NUST Annual Programming Competition has been approved."
            : "We regret to inform you that your registration for the NUST Annual Programming Competition has been declined. Please feel free to apply again in the future.";
        $message .= "\n\nBest regards,\nNUST Annual Programming Competition Team";

        // Send email
        $headers = "From: no-reply@nustcompetition.com\r\n";
        $headers .= "Reply-To: mosesmwatile@gmail.com\r\n";

        if (mail($user_email, $subject, $message, $headers)) {
            $_SESSION['message'] = 'Notification email sent to user.';

            // Proceed with status update or deletion
            if ($action === 'Approved') {
                // Update the registration status to Approved
                $query = "UPDATE registrations SET status = 'Approved' WHERE id = '$id'";
                mysqli_query($conn, $query);
                $_SESSION['message'] .= ' Registration approved successfully.';
            } else {
                // Delete the registration if declined
                $query = "DELETE FROM registrations WHERE id = '$id'";
                mysqli_query($conn, $query);
                $_SESSION['message'] .= ' Registration declined, and user removed from the database.';
            }
        } else {
            $_SESSION['error_message'] = 'Error sending email notification.';
        }
    } else {
        $_SESSION['error_message'] = 'Error: Unable to fetch user data for email notification.';
    }

    header("Location: admin_dashboard.php");
    exit();
} else {
    $_SESSION['error_message'] = 'Invalid action.';
    header("Location: admin_dashboard.php");
    exit();
}
?>
