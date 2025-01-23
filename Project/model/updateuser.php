<?php

$con = mysqli_connect("localhost", "root", "", "agriculture");

if (!$con) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $email = mysqli_real_escape_string($con, $_POST['email']);


    $sql = "UPDATE users SET password = '$password', email = '$email' WHERE name = '$username'";

    if (mysqli_query($con, $sql)) {
        if (mysqli_affected_rows($con) > 0) {
            echo "User updated successfully!";
        } else {
            echo "No user found with the given username.";
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
