<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['logo_file']) && $_FILES['logo_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['logo_file']['tmp_name'];
        $fileName = $_FILES['logo_file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define the allowed file extensions
        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');

        // Check if the file extension is allowed
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Specify the directory where you want to save the uploaded files
            $uploadFileDir = './uploads/sponsors/';

            // Check if the sponsors directory exists, if not, create it
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true); // Create the directory with appropriate permissions
            }

            $dest_path = $uploadFileDir . basename($fileName); // Use basename to avoid directory traversal attacks

            // Check if the file already exists
            if (file_exists($dest_path)) {
                echo "File already exists. Please rename your file and try again.";
            } else {
                // Move the file to the upload directory
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $name = htmlspecialchars(trim($_POST['name']));
                    $description = htmlspecialchars(trim($_POST['description']));

                    // Store the file path and sponsor details in the database
                    $query = "INSERT INTO sponsors (name, logo_url, description) VALUES ('$name', '$dest_path', '$description')";
                    if (mysqli_query($conn, $query)) {
                        header('Location: admin_dashboard.php');
                        exit();
                    } else {
                        echo "Database error: " . mysqli_error($conn);
                    }
                } else {
                    echo "There was an error moving the uploaded file.";
                }
            }
        } else {
            echo "Upload failed. Allowed file types: " . implode(", ", $allowedfileExtensions);
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }
}
?>