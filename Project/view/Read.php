<?php
$con=mysqli_connect("localhost","root","","agriculture");

$sql="SELECT * FROM  `quiz` ";

$result = mysqli_query($con,$sql);
?>

<table border="1">
    <tr>
        <th>Question ID</th>
        <th>Question Name</th>
        <th>Question Type</th>
        <th>Time limit</th>
        <th>Last date of submission</th>
    </tr>

    <tr>
        <?php while($row = mysqli_fetch_assoc($result)){?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['quizname'];?></td>
                <td><?php echo $row['quiztype'];?></td>
                <td><?php echo $row['timelimit'];?></td>
                <td><?php echo $row['lastdate'];?></td>
            </tr>
        <?php }?>
    </tr>
</table>
<?php
mysqli_close($con);

?>
