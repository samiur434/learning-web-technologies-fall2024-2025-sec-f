<?php
header('Content-Type: text/plain'); // Ensure plain text response

$server = "localhost";
$username = "root";
$password = "";
$database = "agriculture";

// Debug log
error_log("Debug: Script execution started");

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    error_log("Database connection failed: " . mysqli_connect_error());
    echo "Database connection failed.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $questionname = mysqli_real_escape_string($con, $_POST["Questionname"]);
    $questiontype = mysqli_real_escape_string($con, $_POST["questiontype"]);
    $timelimit = intval($_POST["timelimit"]);
    $lastdate = mysqli_real_escape_string($con, $_POST["lastdate"]);

    if (empty($questionname) || empty($questiontype) || $timelimit <= 0 || empty($lastdate)) {
        echo "All fields are required, and the time limit must be positive.";
        exit;
    }

    $sql = "INSERT INTO `quiz` (`quizname`, `quiztype`, `timelimit`, `lastdate`) 
            VALUES ('$questionname', '$questiontype', '$timelimit', '$lastdate')";

    if (mysqli_query($con, $sql)) {
        echo "Question inserted successfully!";
    } else {
        error_log("SQL Error: " . mysqli_error($con));
        echo "Failed to insert question.";
    }
} else {
    echo "Invalid request method.";
    exit;
}

mysqli_close($con);
?>
