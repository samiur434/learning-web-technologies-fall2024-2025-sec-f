<?php
function getUserById($conn, $id) {
    $query = "SELECT * FROM users WHERE id = $id";
    return $conn->query($query)->fetch_assoc();
}

function updateUser($conn, $id, $name, $email, $password) {
    if (!empty($password)) {
        $query = "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = $id";
    } else {
        $query = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";
    }
    return $conn->query($query);
}
?>
