<?php

$con = mysqli_connect("localhost", "root", "", "agriculture");

if (!$con) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}


$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }
        td {
            background-color: #fff;
        }
        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        tr:hover td {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>User List</h1>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['password']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php

mysqli_close($con);
?>
