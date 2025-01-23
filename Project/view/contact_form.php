<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<html>
<head><title>Contact Us</title></head>
<body>
    <h1>Contact Us</h1>

    If you need assistance, please feel free to email us at:
    <a href="mailto:agriedu@gmail.com">agriedu@gmail.com</a></br>

    <br>
    <a href="../view/home.php">Back to Home</a>
</body>
</html>
