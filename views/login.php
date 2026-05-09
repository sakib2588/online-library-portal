<!DOCTYPE html>
<html>
<head>
    <title>Login - Library Portal</title>
    <style>
        body { font-family: Arial; background:#eef; padding:30px; }
        table { background:#fff; padding:20px; border:1px solid #ccc; }
        h2 { color:#225; }
        .msg { color:green; }
        .err { color:red; }
        input[type=text], input[type=password] { padding:5px; width:200px; }
    </style>
</head>
<body>

<h2>Library Portal - Login</h2>

<?php
if (isset($_GET["registered"])) {
    echo "<p class='msg'>Registration successful. Please login.</p>";
}
if (isset($_GET["error"])) {
    echo "<p class='err'>Invalid username or password.</p>";
}
?>

<form action="../controllers/process_login.php" method="POST">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <label>
                    <input type="checkbox" name="remember" value="1"> Remember Me (1 week)
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Login">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                New here? <a href="register.php">Register</a>
            </td>
        </tr>
    </table>
</form>

<p><small>Demo credentials: <b>librarian / lib123</b></small></p>

</body>
</html>
