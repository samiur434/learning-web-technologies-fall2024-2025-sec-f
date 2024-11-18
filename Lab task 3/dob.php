<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $errors = [];

    // Validation rules
    if (empty($day) || empty($month) || empty($year)) {
        $errors[] = "Date of Birth cannot be empty.";
    } elseif (!checkdate($month, $day, $year)) {
        $errors[] = "Date must be a valid date.";
    } elseif ($year < 1953 || $year > 1998) {
        $errors[] = "Year must be between 1953 and 1998.";
    }

    // Display result
    if (empty($errors)) {
        echo "Date of Birth is valid: $day/$month/$year";
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>