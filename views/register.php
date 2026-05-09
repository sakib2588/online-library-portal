<!DOCTYPE html>
<html>
<head>
    <title>Member Registration - Library Portal</title>
    <style>
        body { font-family: Arial; background:#eef; padding:30px; }
        table { background:#fff; padding:20px; border:1px solid #ccc; }
        h2 { color:#225; }
        .err { color:red; background:#fee; padding:8px; border:1px solid red; }
        input { padding:5px; width:220px; }
    </style>

    <!-- Client side JavaScript validation (3+ rules) -->
    <script>
    function validateForm() {
        var name     = document.forms["regForm"]["name"].value;
        var email    = document.forms["regForm"]["email"].value;
        var username = document.forms["regForm"]["username"].value;
        var pass     = document.forms["regForm"]["password"].value;
        var conf     = document.forms["regForm"]["confirm"].value;

        // Rule 1: no field empty
        if (name == "" || email == "" || username == "" || pass == "" || conf == "") {
            alert("All fields are required.");
            return false;
        }
        // Rule 2: password length >= 6
        if (pass.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        }
        // Rule 3: passwords must match
        if (pass != conf) {
            alert("Password and Confirm Password do not match.");
            return false;
        }
        return true;
    }
    </script>
</head>
<body>

<h2>Online Library - Member Registration</h2>

<?php
// Show server-side errors if controller bounced us back
if (isset($errorList) && $errorList != "") {
    echo "<div class='err'><b>Please fix the following:</b><br>" . $errorList . "</div>";
}
?>

<form name="regForm"
      action="../controllers/RegisterController.php"
      method="POST"
      enctype="multipart/form-data"
      onsubmit="return validateForm();">

    <table>
        <tr>
            <td>Full Name:</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>Confirm Password:</td>
            <td><input type="password" name="confirm"></td>
        </tr>
        <tr>
            <td>Member Photo (JPG/PNG, max 2MB):</td>
            <td><input type="file" name="photo" accept="image/jpeg,image/png"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Register">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                Already a member? <a href="login.php">Login here</a>
            </td>
        </tr>
    </table>
</form>

</body>
</html>
