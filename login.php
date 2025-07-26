<?php
session_start();

// Database credentials
$servername = "192.168.1.25";
$username = "root";
$password = "M@dan008";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data safely
$user = isset($_POST['username']) ? $_POST['username'] : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';

// Prepare and execute query (use prepared statements for security)
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    // Login successful
    $_SESSION['username'] = $user;
    header("Location: main.html");
    exit();
} else {
    // Login failed
    header("Location: index.html?error=1");
    exit();
}

$stmt->close();
$conn->close();
?>