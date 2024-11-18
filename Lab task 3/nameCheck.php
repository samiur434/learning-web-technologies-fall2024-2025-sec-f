<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $errors = [];

    // Validation rules
    if (empty($name)) {
        $errors[] = "Name cannot be empty.";
    } elseif (!preg_match("/^[a-zA-Z][a-zA-Z .-]*$/", $name)) {
        $errors[] = "Name must start with a letter and can only contain letters, periods, or dashes.";
    } elseif (str_word_count($name) < 2) {
        $errors[] = "Name must contain at least two words.";
    }

    else{
        echo "username is valid";
    }

    // Display result
    if (empty($errors)) {
        echo "Name is valid: $name";
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>