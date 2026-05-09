<?php
// views/dashboard.php - protected page, AJAX book loader
session_start();

// Handle logout directly here (no separate logout.php needed)
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    if (isset($_COOKIE["lib_user"])) {
        setcookie("lib_user", "", time() - 3600, "/");
    }
    header("Location: login.php");
    exit;
}

// Block unauthenticated visitors
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION["username"];
//$cookieMsg = isset($_COOKIE["lib_user"])
//    ? "Cookie 'lib_user' is set (Remember Me active)."
//    : "No 'lib_user' cookie found.";
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Library Portal</title>
    <style>
        body { font-family: Arial; background:#f4f4ff; padding:30px; }
        h2 { color:#225; }
        table { border-collapse: collapse; margin-top:15px; background:#fff; }
        th, td { border:1px solid #888; padding:8px 12px; }
        th { background:#225; color:#fff; }
        .err { color:red; }
        button { padding:8px 14px; cursor:pointer; }
    </style>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($user); ?>!</h2>
<p><?php echo $cookieMsg; ?></p>
<p><a href="dashboard.php?logout=1">Logout</a></p>

<hr>

<h3>Available Books</h3>
<button onclick="loadBooks()">Load Available Books</button>
<p id="status"></p>

<table id="booksTable">
    <thead>
        <tr><th>ID</th><th>Title</th><th>Author</th><th>Category</th></tr>
    </thead>
    <tbody></tbody>
</table>

<!-- Raw AJAX using XMLHttpRequest - no libraries, no page reload -->
<script>
function loadBooks() {
    var statusEl = document.getElementById("status");
    var tbody    = document.querySelector("#booksTable tbody");
    statusEl.textContent = "Loading...";
    tbody.innerHTML = "";

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../get_books.php", true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var books = JSON.parse(xhr.responseText);
                statusEl.textContent = "Loaded " + books.length + " books.";
                for (var i = 0; i < books.length; i++) {
                    var b = books[i];
                    var row = "<tr><td>" + b.id + "</td><td>" + b.title +
                              "</td><td>" + b.author + "</td><td>" +
                              b.category + "</td></tr>";
                    tbody.innerHTML += row;
                }
            } else {
                statusEl.innerHTML = "<span class='err'>Failed to load books.</span>";
            }
        }
    };

    xhr.send();
}
</script>

</body>
</html>
