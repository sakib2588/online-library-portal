<?php
// controllers/process_login.php
// Validates hardcoded credentials, sets session + optional cookie.

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]) ? true : false;
    // here the ? true : false is a ternary operator that checks if the "remember" checkbox is set in the POST data. If it is set, 
    // $remember will be true; otherwise, it will be false. This allows us to easily determine whether the user wants to be remembered 
    // or not when they log in.

    // Hardcoded credentials as required by the spec
    $validUser = "librarian";
    $validPass = "lib123";

    if ($username == $validUser && $password == $validPass)// if the provided username and password match the hardcoded valid // credentials
        {

        // Save into session
        $_SESSION["username"] = $username; // this line stores the username in the session, allowing us to identify 
        // the user across different pages of the website.

        // Set a one-week cookie only when "Remember Me" is ticked
        if ($remember) {
            setcookie("lib_user", $username, time() + (7 * 24 * 60 * 60), "/"); // expires in 7 days, 
            // available site-wide and secure flag can be added if using HTTPS 
            // lib_user is the name of the cookie, $username is the value, time() + (7 * 24 * 60 * 60) sets the expiration 
            // time to one week from now, and "/" means the cookie is available across the entire website.

            // what will happen if i write any thing else instead of lib_user 
            // ans : if i write lib_user1 or lib_user2 or any thing else instead of lib_user than the cookie will be set 
            // with that name and you can access it using $_COOKIE["lib_user1"] or $_COOKIE["lib_user2"] depending on 
            // what you set.
        }

        header("Location: ../views/dashboard.php"); // this headers is for redirection to the dashboard page after successful login
        exit;

    } else {
        header("Location: ../views/login.php?error=1"); // this header is for redirection back to the login page with an
        //  error query parameter if the credentials are invalid
        exit;
    }

}
else {
    header("Location: ../views/login.php"); // this header is for redirection back to the login page if the request method 
    // is not POST (e.g., if someone tries to access this page directly)
    exit;
}
?>
