<?php

$con = mysqli_connect("localhost", "root", "", "agriculture");


if (!$con) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questionname = mysqli_real_escape_string($con, $_POST["Questionname"]); 
    $questiontype = mysqli_real_escape_string($con, $_POST["questiontype"]);
    $timelimit = intval($_POST["timelimit"]); 
    $lastdate = mysqli_real_escape_string($con, $_POST["lastdate"]);

    
    $sql = "UPDATE `quiz` SET 
             
            `quiztype` = '$questiontype', 
            `timelimit` = $timelimit, 
            `lastdate` = '$lastdate' 
            WHERE `quizname` = '$questionname'";

    
    if (mysqli_query($con, $sql)) {
        echo "Question updated successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}




mysqli_close($con);
?>
