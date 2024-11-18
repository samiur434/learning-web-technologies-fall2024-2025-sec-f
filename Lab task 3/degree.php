<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $degrees = $_POST['degree'] ?? [];
    $errors = [];

    // Validation rule
    if (count($degrees) < 2) {
        $errors[] = "Please select at least two degrees.";
    }

    // Display result
    if (empty($errors)) {
        echo "Degrees selected: " . implode(", ", $degrees);
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>