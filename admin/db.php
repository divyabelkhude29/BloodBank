<?php
session_start();

$servername = "localhost";
$username = "root";  // change if needed
$password = "";      // change if needed
$dbname = "bloodbank";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if admin is logged in for protected pages
function check_login() {
    if (!isset($_SESSION['admin_logged_in'])) {
        header("Location: login.php");
        exit();
    }
}
?>