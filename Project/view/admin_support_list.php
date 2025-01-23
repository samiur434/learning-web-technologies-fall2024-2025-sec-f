<?php
session_start();
require_once "../Controller/supportController.php";

// Ensure admin session is set
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../view/login_form.php");
    exit();
}

// Fetch all tickets
$tickets = getAllTickets();

// Debugging: Print tickets to verify data
echo '<pre>';
print_r($tickets);
echo '</pre>';
?>
<html>
<head><title>All Support Tickets</title></head>
<body>
    <h1>All Support Tickets</h1>
    <?php if (empty($tickets)) { ?>
        <p>No support tickets available.</p>
    <?php } else { ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Title</th>
                <th>Message</th>
            </tr>
            <?php foreach ($tickets as $ticket) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket['id']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['title']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['message']); ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</body>
</html>
