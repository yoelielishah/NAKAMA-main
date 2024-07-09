<?php
// Database connection
$servername = "localhost"; 
$username = "NakamaLMS";        
$password = "@onlinelms7";            
$dbname = "nakamalms";     

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validating if the passwords match
if ($password != $confirm_password) {
    die("Passwords do not match.");
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new createacc user into the database
$sql = "INSERT INTO createacc (Full_Name, Email, Pass) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $full_name, $email, $hashed_password);

if ($stmt->execute()) {
    echo "Account created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
