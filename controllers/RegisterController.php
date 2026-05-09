<?php
// controllers/RegisterController.php
// Receives the registration form, validates, then calls the model.

$hasError = false;
$errors   = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pull the form values
    $name     = trim($_POST["name"]);
    $email    = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm  = $_POST["confirm"];

    // ---- 6+ Server-side PHP validations using $hasError flag ----

    // 1) No empty fields
    if ($name == "" || $email == "" || $username == "" || $password == "" || $confirm == "") {
        $hasError = true;
        $errors .= "All fields are required.<br>";
    }

    // 2) Valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hasError = true;
        $errors .= "Invalid email address.<br>";
    }

    // 3) Name only letters and spaces
    if (!preg_match("/^[A-Za-z ]+$/", $name)) {
        $hasError = true;
        $errors .= "Name must contain letters and spaces only.<br>";
    }

    // 4) Username 4-15 characters
    if (strlen($username) < 4 || strlen($username) > 15) {
        $hasError = true;
        $errors .= "Username must be 4 to 15 characters.<br>";
    }

    // 5) Password at least 6 chars
    if (strlen($password) < 6) {
        $hasError = true;
        $errors .= "Password must be at least 6 characters.<br>";
    }

    // 6) Password matches confirm
    if ($password != $confirm) {
        $hasError = true;
        $errors .= "Password and Confirm Password do not match.<br>";
    }

    // 7) Photo upload check (file required + extension + size)
    $filename = $_FILES["photo"]["name"];
    $ext  = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $size = $_FILES["photo"]["size"];

    if ($_FILES["photo"]["name"] == "") {
        $hasError = true;
        $errors .= "File required.<br>";
    }
    if ($ext != "jpg" && $ext != "png") {
        $hasError = true;
        $errors .= "JPG/PNG only.<br>";
    }
    if ($size > 2097152) {
        $hasError = true;
        $errors .= "Max 2MB allowed.<br>";
    }

    // Only call the model when nothing failed
    if ($hasError == false) {
        require_once __DIR__ . "/../model/Member.php";

        // Block duplicate usernames
        if (memberExists($username)) {
            $errors .= "Username already taken.<br>";
            $hasError = true;
        } else {
            addMember(
                $name, $email, $username, $password, $_FILES["photo"]["tmp_name"],$filename
            );
            header("Location: ../views/login.php?registered=1"); //this header is for redirection to the login page with a query parameter
            //  indicating successful registration
            exit;
        }
    }

    // If we get here, something failed -> show the form again with errors
    $errorList = $errors;
    include __DIR__ . "/../views/register.php";
    exit;

} 
else {
    // Direct hit -> just show the form
    include __DIR__ . "/../views/register.php";
}
?>
