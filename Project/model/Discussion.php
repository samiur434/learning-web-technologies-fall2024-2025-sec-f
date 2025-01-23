<?php
$con = mysqli_connect("localhost", "root", "", "agriculture");


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $discussion = mysqli_real_escape_string($con, $_POST['discussion']);

    $sql = "INSERT INTO `enquiry` (`Email`, `Discussion Area`) VALUES ('$email', '$discussion')";

    if (mysqli_query($con, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}


mysqli_close($con);
?>
