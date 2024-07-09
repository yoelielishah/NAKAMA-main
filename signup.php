<?php
// Enable error reporting for debugging (remove or comment out in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
// $email = $_POST['email'];
// $password = $_POST['password'];

// Retrieve from database

// Check if form data is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Check if email and password are provided
if (!empty($email) && !empty($password)) {
// Check if the user exists and validate password
$sql = "SELECT * FROM createacc WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $createacc = $result->fetch_assoc();
    // verify the hashed password
    if (password_verify($password, $createacc['Pass'])) {
        header("Location : lmshomepage.html");
        // echo "Login successful!";
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No account found with this email.";
}

$stmt->close();
} else {
    echo  "Please enter both email and passwords. ";
} 
}else {
    echo "Invalid access.";
 }
$conn->close();
?>