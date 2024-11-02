<?php
session_start();

$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "my_database"; // replace with your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the admin login successfully
if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
    // Start a session and set the "loggedin" variable to true
    $_SESSION['loggedin'] = true;
    // Redirect to index.php if the admin login successfully
    header("Location: index.php");
    exit;
} else {
    // Redirect back to the login page with an error message
    header("Location: login.php?error=1");
    exit;
}
?>
