<?php
session_start();
require_once "../Controller/supportController.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $message = $_POST['message'] ?? '';

    $result = addTicket($title, $message);

    if ($result) {
        header("Location: support_list.php?success=Ticket added successfully");
        exit();
    } else {
        $error = "Failed to add ticket. Please ensure all fields are filled.";
    }
}
?>
<html>
<head><title>Add Support Ticket</title></head>
<body>
    <h1>Add Support Ticket</h1>
    <?php if (isset($error)) { ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="">
        <label>Title:</label>
        <input type="text" name="title" required><br>
        <label>Message:</label>
        <textarea name="message" required></textarea><br>
        <button type="submit">Add Ticket</button>
    </form>
    <br>
    <a href="support_list.php">Back to Ticket List</a>
</body>
</html>
