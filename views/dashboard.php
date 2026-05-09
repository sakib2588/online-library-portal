<?php
// views/dashboard.php - protected page with AJAX book loader
session_start();

// Logout
if (isset($_GET["logout"])) {
    session_destroy();
    setcookie("lib_user", "", time() - 3600, "/");
    header("Location: login.php");
    exit;
}

// Auth check
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f4f4ff; }
        table { border-collapse: collapse; margin-top: 15px; background: #fff; }
        th, td { border: 1px solid #888; padding: 8px 12px; }
        th { background: #225; color: #fff; }
        button { padding: 8px 14px; cursor: pointer; }
    </style>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($user); ?>!</h2>
<p><a href="dashboard.php?logout=1">Logout</a></p>

<hr>

<h3>Available Books</h3>
<button onclick="loadBooks()">Load Books</button>
<p id="status"></p>

<table id="booksTable">
    <tr><th>ID</th><th>Title</th><th>Author</th><th>Category</th></tr>
</table>

<script>
function loadBooks() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../get_books.php", true);
    xhr.onload = function() {
        var books = JSON.parse(xhr.responseText);
        document.getElementById("status").textContent = "Loaded " + books.length + " books.";
        for (var i = 0; i < books.length; i++) {
            var b = books[i];
            document.getElementById("booksTable").innerHTML +=
                "<tr><td>" + b.id + "</td><td>" + b.title + "</td><td>" + b.author + "</td><td>" + b.category + "</td></tr>";
        }
    };
    xhr.send();
}
</script>

</body>
</html>
