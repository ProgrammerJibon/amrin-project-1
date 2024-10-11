<?php
require_once 'config.php'; // Include the config file

// Check if the category ID is set in the URL
if (isset($_GET['id'])) {
    $category_id = intval($_GET['id']); // Sanitize the input

    // Fetch the category name (optional)
    $category_query = "SELECT cat_name FROM book_cats WHERE id = '$category_id'";
    $category_result = mysqli_query($connect, $category_query);
    $category = mysqli_fetch_assoc($category_result);
    
    // Fetch books for the selected category
    $books_query = "SELECT * FROM book_items WHERE book_cat_id = '$category_id'";
    $books = mysqli_query($connect, $books_query);
} else {
    // If no category ID is provided, redirect or show an error
    exit("No category ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_styles.css"> <!-- Common CSS -->
    <title><?php echo $category['cat_name']; ?> - Books</title>
</head>
<body>

    <h1><?php echo $category['cat_name']; ?> Books</h1>
    <div class="book-list">
        <?php while ($book = mysqli_fetch_assoc($books)) { ?>
            <div class="book-item">
                <a href="<?php echo $book['pdf_path']; ?>" target="_blank" class="book-link">
                    <img src="<?php echo $book['book_cover']; ?>" alt="<?php echo $book['book_name']; ?>" class="book-cover">
                    <h2 class="book-title"><?php echo $book['book_name']; ?></h2>
                </a>
            </div>
        <?php } ?>
    </div>

</body>
</html>
