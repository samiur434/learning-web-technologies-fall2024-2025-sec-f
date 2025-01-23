<?php

$con = mysqli_connect("localhost", "root", "", "agriculture");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $questionname = mysqli_real_escape_string($con, $_POST["questionname"]);

    
    if (!empty($questionname)) {
    
        $sql = "DELETE FROM `quiz` WHERE `quizname` = '$questionname'";

    
        if (mysqli_query($con, $sql)) {
            if (mysqli_affected_rows($con) > 0) {
                echo "Question deleted successfully!";
            } else {
                echo "No question found with the given name.";
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Please provide a valid question name.";
    }
}


?>