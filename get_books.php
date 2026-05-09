<?php
// get_books.php - returns books.json content as JSON for the AJAX call
header("Content-Type: application/json");

$file = __DIR__ . "/books.json";

if (!file_exists($file)) {
    http_response_code(404);
    echo json_encode(array("error" => "books.json not found"));
    exit;
}

$data = file_get_contents($file);
$books = json_decode($data, true);

if ($books === null) {
    http_response_code(500);
    echo json_encode(array("error" => "Invalid JSON in books.json"));
    exit;
}

echo json_encode($books);
?>
