<?php
require_once('database-connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $_POST['id'];
    $declared_amount = $data['declared_amount'];
    $undeclared_amount = $data['undeclared_amount'];
    $undeclared_expenses = $data['undeclared_expenses'];

    $sql = "UPDATE recettes SET declared_amount = $declared_amount, undeclared_amount = $undeclared_amount, undeclared_expenses = $undeclared_expenses WHERE id = $id";
    mysqli_query($conn, $sql);

    echo 'success';
}
