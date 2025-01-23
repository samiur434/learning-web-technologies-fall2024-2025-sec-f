<?php

$con = mysqli_connect("localhost", "root", "", "agriculture");


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM users_progress";
$result = mysqli_query($con, $sql);


$userProgressData = [];


if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $userProgressData[] = [
            'username' => $row['username'],
            'progress' => $row['progress']
        ];
    }
} else {
  
    $userProgressData = ['message' => 'No data available'];
}

echo json_encode($userProgressData);

mysqli_close($con);
?>
