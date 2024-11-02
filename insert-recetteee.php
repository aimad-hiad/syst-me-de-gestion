<?php
require_once('database-connection.php');

// check if form is submitted
if (isset($_POST['submit'])) {
    // get form data
    $date = $_POST['date'];
    $declared_amount = $_POST['declared_amount'];
    $undeclared_amount = $_POST['undeclared_amount'];
    $undeclared_expenses = $_POST['undeclared_expenses'];

    // prepare insert query
    $query = "INSERT INTO recettes (date, declared_amount, undeclared_amount, undeclared_expenses) VALUES (?, ?, ?, ?)";

    // prepare statement
    $stmt = mysqli_prepare($conn, $query);

    // bind parameters
    mysqli_stmt_bind_param($stmt, "siii", $date, $declared_amount, $undeclared_amount, $undeclared_expenses);

    // execute statement
    if (mysqli_stmt_execute($stmt)) {
        // redirect to recettes.php with success message
        header("Location: recettes.php?success=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // close statement
    mysqli_stmt_close($stmt);
}

// close connection
mysqli_close($conn);
?>
