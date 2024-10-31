<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['media_file']) && $_FILES['media_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['media_file']['tmp_name'];
        $fileName = $_FILES['media_file']['name'];
        $fileSize = $_FILES['media_file']['size'];
        $fileType = $_FILES['media_file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Define the allowed file extensions
        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov');

        // Check if the file extension is allowed
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Specify the directory where you want to save the uploaded files
            $uploadFileDir = './uploads/';
            
            // Check if the uploads directory exists, if not, create it
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
                    $description = htmlspecialchars(trim($_POST['description']));

                    // Store the file path in the database
                    $query = "INSERT INTO gallery (image_url, description) VALUES ('$dest_path', '$description')";
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