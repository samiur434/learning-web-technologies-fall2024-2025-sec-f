<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    // Validation
    if (!preg_match("/^[A-Za-z]+$/", $username)) {
        die("Error: Username can only contain letters.");
    }
    if (strlen($password) < 8) {
        die("Error: Password must be at least 8 characters long.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    // Connect to database
    $con = mysqli_connect("localhost", "root", "", "agriculture");
    if (!$con) {
        die("Error: Unable to connect to the database.");
    }

    // Insert into database
    $sql = "INSERT INTO users (name, password, email) VALUES ('$username', '$password', '$email')";
    if (mysqli_query($con, $sql)) {
        echo "Signup successful! Redirecting to login page...";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
} else {
    die("Invalid request method.");
}
?>

