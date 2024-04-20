<?php
// Include your database connection file
include '../components/connect.php';

// Prepare a query to select all categories
$select_categories = $conn->prepare("SELECT * FROM `category`");

// Execute the query
$select_categories->execute();

// Fetch the categories as associative array
$categories = $select_categories->fetchAll(PDO::FETCH_ASSOC);

// Set the response header to JSON
header('Content-Type: application/json');

// Encode the categories array as JSON and echo it
echo json_encode($categories);
