<?php
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

// Display a success message if the connection is established
session_start();
if(isset($_SESSION["loggedit"])){
  $user = $_SESSION["loggedin"];
  $sql = "SELECT fullname FROM users WHERE username = '$user'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if(isset($row["fullname"]) && !empty($row["fullname"])) {
      $fullname = $row["fullname"];
    }
  }
  header("Location: login.php");
  exit();
}
?>