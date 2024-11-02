<?php
require_once 'database-connection.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!empty($_POST['date']) && !empty($_POST['charge_name']) && isset($_POST['amount'])) {
    $date = $_POST['date'];
    $charge_name = $_POST['charge_name'];
    $amount = $_POST['amount'];
    
    $sql = "UPDATE charges SET $charge_name = '$amount' WHERE date = '$date'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid parameters";
}

// Close the database connection
$conn->close();
?>
