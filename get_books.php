<?php
// get_books.php - returns books.json as JSON for AJAX
header("Content-Type: application/json");
echo file_get_contents(__DIR__ . "/books.json");
?>
