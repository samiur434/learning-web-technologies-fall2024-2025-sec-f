<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = $_POST['gender'] ?? null;
    $errors = [];

    // Validation rule
    if (empty($gender)) {
        $errors[] = "Please select your gender.";
    }

    // Display result
    if (empty($errors)) {
        echo "Gender selected: $gender";
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>