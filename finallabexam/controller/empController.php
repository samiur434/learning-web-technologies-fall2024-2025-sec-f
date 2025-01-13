<?php
include_once "../model/empmodel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'search') {
    $searchTerm = trim($_POST['search_term']);
    $conn = get_connection();

    $sql = "SELECT * FROM employee WHERE user_name LIKE '%$searchTerm%' OR emp_name LIKE '%$searchTerm%' OR contact_no LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['user_name']}</td>
                    <td>{$row['emp_name']}</td>
                    <td>{$row['contact_no']}</td>
                    <td>
                        <a href='updateemp.php?user_name={$row['user_name']}'>Update</a>
                        <a href='../controller/deleteemp.php?user_name={$row['user_name']}' onclick=\"return confirm('Are you sure you want to delete this emp?');\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No emp found</td></tr>";
    }

    mysqli_close($conn);
}
?>