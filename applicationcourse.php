<?php
// Database credentials
$servername = "localhost";  
$username = "NakamaLMS";         
$password = "@onlinelms7";             
$dbname = "nakamalms";     

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and capture form data
    $first_name = $conn->real_escape_string($_POST['First_Name']);
    $middle_name = $conn->real_escape_string($_POST['Middle_Name']);
    $last_name = $conn->real_escape_string($_POST['Last_Name']);
    $email = $conn->real_escape_string($_POST['email']);
    $birthdate = $conn->real_escape_string($_POST['birthdate']);
    $course = $conn->real_escape_string($_POST['course']);
    $skills = $conn->real_escape_string($_POST['skills']);
    //$attachment = $_FILES['attachment']['name'];
    $attachment_path = "";

    // Move uploaded file to a directory
    /*
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($attachment);
    */
     /*
    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $upload_file)) {
        // File upload successful
        $attachment_path = $upload_file;
    } else {
        $attachment_path = "";
    }
    */



        // Check if a file is uploaded
    /*
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
            $attachment = $_FILES['attachment']['name'];
            $upload_dir = 'uploads/';
            $upload_file = $upload_dir . basename($attachment);
    
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $upload_file)) {
                // File upload successful
                $attachment_path = $upload_file;
            } else {
                echo "File upload failed.";
            }
        } else {
            echo "No file was uploaded.";
        }
        
    */

    // Check if a file is uploaded
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
        $attachment = $_FILES['attachment']['name'];
        $upload_dir = 'uploads/';

        // Create the uploads directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0775, true); // Creates the directory with correct permissions
        }

        $upload_file = $upload_dir . basename($attachment);

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $upload_file)) {
            // File upload successful
            $attachment_path = $upload_file;
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "No file was uploaded.";
    }

    
    // Insert form data into the database
    $sql = "INSERT INTO applications (first_name, middle_name, last_name, email, birthdate, course, skills, attachment_path)
            VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$birthdate', '$course', '$skills', '$attachment_path')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

