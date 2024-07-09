<?php
// Database credentials
$servername = "localhost";  
$username = "NakamaLMS";         
$password = "@onlinelms7";             
$dbname = "nakamalms";     


$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and capture form data
    $first_name = $conn->real_escape_string($_POST['fname']);
    $last_name = $conn->real_escape_string($_POST['lname']);
    $business_name = $conn->real_escape_string($_POST['bname']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $industry = $conn->real_escape_string($_POST['industry']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // Insert form data into the database
    $sql = "INSERT INTO contact_form (first_name, last_name, business_name, phone, industry, message)
            VALUES ('$first_name', '$last_name', '$business_name', '$phone', '$industry', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
