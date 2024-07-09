// nakama lms in uploading a file 

<?php
$servername = "localhost";
$username = "NakamaLMS";
$password = "@onlinelms7";
$dbname = "nakamalms";

// Retrieve form data
$val1 = $_POST['First_Name'];
$val2 = $_POST['Middle_Name'];
$val3 = $_POST['Last_Name'];
$val4 = $_POST['email'];
$val5 = $_POST['birthdate'];

// Handle multiple checkboxes for education
if (isset($_POST['Education'])) {
    $val6 = implode(", ", $_POST['Education']); // Convert array to comma-separated string
} else {
    $val6 = "";
}

// Handle radio button for department
if (isset($_POST['department'])) {
   // Debugging: Inspect the value of department
   var_dump($_POST['department']);
   $val7 = $_POST['department']; // This line will show the warning if $_POST['department'] is an array
} else {
   $val7 = "";
}


$val8 = $_POST['msg'];

// Handle file upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
$val9 = $target_file;

// Check if the directory exists, if not, create it
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["myfile"]["name"])) . " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to insert the form data into the database
$sql = "INSERT INTO Form_Registration (First_Name, Middle_Name, Last_Name, Email_Address, Birthdate, Level_of_Education, Departments, Skills, Attach_Files)
        VALUES ('$val1', '$val2', '$val3', '$val4', '$val5', '$val6', '$val7', '$val8', '$val9')";

if ($conn->query($sql) === TRUE) {
    echo "Registration details inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>