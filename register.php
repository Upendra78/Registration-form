<?php
$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "user_db"; // Your database name

// Create connection
$con = new mysqli($servername, $username, $password);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
// Create users table if it does not exist
 if(mysqli_query($con, $sql)){
    $con = mysqli_connect($servername, $username, $password, $dbname);
    $Sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    hobbies TEXT NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($con->query($Sql) === FALSE) {
    die("Error creating table: " . $conn->error);
}
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $hobbies = $_POST['hobby']; // This will be an array
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Convert the array of hobbies to a comma-separated string
    $hobbies_str = implode(", ", $hobbies);

    // Hash the password
    //$hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database
    $sql = "INSERT INTO users (name, email, phone, hobbies, password) VALUES ('$name', '$email', '$phone', '$hobbies_str', '$password')";

    if ($con->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$con->close();
?>
