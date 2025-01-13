<?php
include_once "../model/empmodel.php";

if (isset($_GET['user_name'])) {
    $user_name = $_GET['user_name'];
    $conn = get_connection();

    $sql = "DELETE FROM employee WHERE user_name = '$user_name'";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: ../view/authList.php?message=deleted");
    } else {
        mysqli_close($conn);
        header("Location: ../view/authList.php?message=error");
    }
}
?>