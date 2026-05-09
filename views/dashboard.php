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

<table>
    <thead> // Table header for book list
        <tr><th>ID</th><th>Title</th><th>Author</th><th>Category</th></tr>
    </thead>
    <tbody id="booksTable"></tbody> // Table body where book rows will be inserted by JavaScript
</table>

<script>
function loadBooks() {
    const xhr = new XMLHttpRequest(); // Create AJAX request
    xhr.open("GET", "../get_books.php", true); // Request book data from server
    xhr.onload = function() {
        const books = JSON.parse(xhr.responseText); // Parse JSON response
        let rows = ""; // Build HTML rows for each book
        for (let i = 0; i < books.length; i++) {
            const b = books[i];
            rows += `<tr><td>${b.id}</td><td>${b.title}</td><td>${b.author}</td><td>${b.category}</td></tr>`; 
            // Append book data to rows string
        }
        document.getElementById("booksTable").innerHTML = rows; // Insert rows into table body
        //document.getElementById("status").textContent = `Loaded ${books.length} books.`; 
        // Update status message
    };
    xhr.send(); // Send AJAX request
}
</script>

</body>
</html>
