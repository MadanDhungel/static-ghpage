<?php
$mysqli = new mysqli("localhost", "root", "", "LearnGit");

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    echo "Login successful!";
} else {
    echo "Invalid username or password.";
}
?>
