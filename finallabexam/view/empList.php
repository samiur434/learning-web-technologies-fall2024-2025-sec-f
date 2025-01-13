<?php
include_once "../model/empmodel.php";
$conn = get_connection();
$sql = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee List</title>
    <script>
        function searchEmp() {
            const search = document.getElementById('search').value.trim();
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controller/empController.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById('empTable').innerHTML = this.responseText;
                }
            };
            xhr.send("action=search&search_term=" + encodeURIComponent(search));
        }
    </script>
</head>
<body>
    <h1>Employee List</h1>
    <?php
    if (isset($_GET['message'])) {
        if ($_GET['message'] == 'updated') {
            echo "<p>Employee updated successfully.</p>";
        } elseif ($_GET['message'] == 'error') {
            echo "<p>Error performing operation.</p>";
        }
        if ($_GET['message'] == 'deleted') {
            echo "<p>Employee deleted successfully.</p>";
        } elseif ($_GET['message'] == 'error') {
            echo "<p>Error deleting employee.</p>";
        }
    }
    ?>
    <input 
        type="text" 
        id="search" 
        placeholder="Search Employees using Name, Username, or Contact" 
        onkeyup="searchEmp()"
    >
    <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>Employee Name</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="empTable">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['user_name']}</td>
                            <td>{$row['emp_name']}</td>
                            <td>{$row['contact_no']}</td>
                            <td>
                                <a href='updateEmp.php?user_name={$row['user_name']}'>Update</a> |
                                <a href='../controller/deleteEmp.php?user_name={$row['user_name']}'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No employees found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="home.php">Back to Home</a>
</body>
</html>
