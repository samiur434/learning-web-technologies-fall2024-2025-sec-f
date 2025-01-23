<?php
$con=mysqli_connect("localhost","root","","agriculture");

$sql = "SELECT * FROM leaderboard ORDER BY score DESC";

$result = mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <style>
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color:rgb(193, 161, 3);
            
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Leaderboard</h1>
    <table>
        <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>quiz</th>
            <th>Score</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $rank = 1; 
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $rank . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['quiz'] . "</td>";
                echo "<td>" . $row['score'] . "</td>";
                echo "</tr>";
                $rank++;
            }
        } else {
            echo "<tr><td colspan='3'>No data available</td></tr>";
        }
        ?>
    </table>
</body>
</html>

