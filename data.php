<?php
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

// Get the year and month filter parameters from the request
$year = $_GET['year'] ?? date('Y');
$month = $_GET['month'] ?? '';

// Prepare the SQL query to fetch the profit data
$sql = "SELECT MONTH(date) as month, SUM(declared_amount + undeclared_amount - undeclared_expenses) as revenue, 
        SUM(electricite + eau + loyer + gasoil + abonnements + comptable + marchandises + `URSSAF Décroissant 1` + salaires + autres) as expenses 
        FROM recettes 
        JOIN charges ON YEAR(recettes.date) = YEAR(charges.date) AND MONTH(recettes.date) = MONTH(charges.date) 
        WHERE YEAR(recettes.date) = $year ";

if ($month) {
    $sql .= "AND MONTH(recettes.date) = $month ";
}

$sql .= "GROUP BY MONTH(date) ORDER BY MONTH(date)";

// Execute the query
$result = $conn->query($sql);

// Fetch the data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $month_name = date("F", mktime(0, 0, 0, $row['month'], 1));
    $profit = $row['revenue'] - $row['expenses'];
    $data[] = array('month' => $month_name, 'profit' => $profit);
}

// Close the connection
$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
