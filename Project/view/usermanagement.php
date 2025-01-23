<?php
session_start();
$conn = new mysqli('127.0.0.1', 'root', '', 'agriculture');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM users";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
</head>
<body>
    <h1>Admin Panel - Manage Users</h1>

    <h2>Add New User</h2>
    <form action="../Controller/usermanagementController.php?action=create" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Add User</button>
    </form>

    <hr>

    <h2>Existing Users</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<p>Name: " . htmlspecialchars($row['username']) . "</p>";
            echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";

            echo "<form action='../Controller/usermanagementController.php?action=update' method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<label for='name'>Name:</label>";
            echo "<input type='text' name='name' value='" . (isset($row['name']) ? htmlspecialchars($row['name']) : '') . "' required>";
            echo "<br>";
            echo "<label for='email'>Email:</label>";
            echo "<input type='email' name='email' value='" . (isset($row['email']) ? htmlspecialchars($row['email']) : '') . "' required>";
            echo "<br>";
            echo "<label for='password'>Password:</label>";
            echo "<input type='password' name='password' placeholder='Leave blank to keep existing password'>";
            echo "<br>";
            echo "<button type='submit'>Update User</button>";
            echo "</form>";

            // Delete form
            echo "<form action='../Controller/usermanagementController.php?action=delete' method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<button type='submit'>Delete User</button>";
            echo "</form>";

            echo "</div><hr>";
        }
    } else {
        echo "<p>No users found.</p>";
    }
    ?>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>