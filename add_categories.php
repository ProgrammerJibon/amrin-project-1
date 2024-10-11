<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cat_name = $_POST['cat_name'];
    $cover_path = "";

    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == UPLOAD_ERR_OK) {
        $cover_path = upload($_FILES['cover_image']['tmp_name']);
    }

    $query = "INSERT INTO book_cats (cat_name, cover_path) VALUES ('$cat_name', '$cover_path')";
    if (mysqli_query($connect, $query)) {
        echo "Category added successfully!";
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM book_cats WHERE id = '$delete_id'";
    if (mysqli_query($connect, $delete_query)) {
        echo "Category deleted successfully!";
        header("Refresh: 1;url=/admin.php?page=categories");
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

// Fetch categories and the number of books in each category
$categories_query = "
    SELECT bc.id, bc.cat_name, bc.cover_path, COUNT(bi.id) AS book_count 
    FROM book_cats bc 
    LEFT JOIN book_items bi ON bc.id = bi.book_cat_id 
    GROUP BY bc.id";
$categories_result = mysqli_query($connect, $categories_query);
?>

<div class="container">
    <h2 class="head">Add Book Category</h2>
    <form method="POST" enctype="multipart/form-data" class="admin-form">
        <div class="form-group">
            <label for="cat_name">Category Name:</label>
            <input type="text" name="cat_name" id="cat_name" required>
        </div>
        <div class="form-group">
            <label for="cover_image">Category Cover Image:</label>
            <input type="file" name="cover_image" id="cover_image" required>
        </div>
        <button type="submit" class="btn">Add Category</button>
    </form>

    <h2 class="head">Categories List</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Cover Image</th>
                <th>Number of Books</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($categories_result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['cat_name']); ?></td>
                    <td>
                        <?php if ($row['cover_path']) { ?>
                            <img src="<?php echo $row['cover_path']; ?>" alt="<?php echo htmlspecialchars($row['cat_name']); ?>" style="width: 50px; height: auto;">
                        <?php } ?>
                    </td>
                    <td><?php echo $row['book_count']; ?></td>
                    <td>
                        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this category?")) {
        window.location.href = "?page=categories&delete_id=" + id;
    }
}
</script>
