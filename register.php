<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_page";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    // Check if username or email already exists
    $checkUser = "SELECT * FROM users WHERE username='$user' OR email='$email'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        echo "Username or email already exists";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful";
            echo"<button>Click here to login</button>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
