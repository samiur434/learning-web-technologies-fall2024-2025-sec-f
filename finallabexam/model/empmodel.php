<?php
session_start();

function get_connection() {
    $conn = mysqli_connect("127.0.0.1", "root", "", "employee");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
function add_user($user_name, $emp_name, $contact_no, $password) {
    $conn = get_connection();
    $sql = "INSERT INTO employee (user_name, emp_name, contact_no, password) 
            VALUES ('$user_name', '$emp_name', '$contact_no', '$password')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}


function user_login($user_name, $password) {
    $conn = get_connection();
    $sql = "SELECT * FROM employee WHERE user_name='$user_name' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row_count = mysqli_num_rows($result);
    mysqli_close($conn);
    return $row_count > 0;
}

function delete_user($user_name) {
    $conn = get_connection();
    $sql = "DELETE FROM employee WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function get_all_users() {
    $conn = get_connection();
    $sql = "SELECT * FROM employee";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}
?>