<?php
// Include your database connection file
include '../components/connect.php';

// Check if the category_id parameter is set in the request
if (isset($_GET['category_id'])) {
    // Retrieve the category ID from the request
    $categoryId = $_GET['category_id'];

    // Prepare a query to select subcategories based on the provided category ID
    $select_sub_categories = $conn->prepare("SELECT * FROM `subcategory` WHERE category_id = ?");
    $select_sub_categories->execute([$categoryId]);

    // Fetch the subcategories as associative array
    $subCategories = $select_sub_categories->fetchAll(PDO::FETCH_ASSOC);

    // Set the response header to JSON
    header('Content-Type: application/json');

    // Encode the subcategories array as JSON and echo it
    echo json_encode($subCategories);
}
