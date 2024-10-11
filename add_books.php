<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_name = $_POST['book_name'];
    $book_cover = "";
    $pdf_path = "";
    $book_details = $_POST['book_details'];
    $book_cat_id = $_POST['book_cat_id'];

    if (isset($_FILES['book_cover']) && $_FILES['book_cover']['error'] == UPLOAD_ERR_OK) {
        $book_cover = upload($_FILES['book_cover']['tmp_name']);
    }

    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {
        $pdf_path = upload($_FILES['pdf_file']['tmp_name'], 'pdf');
    }

    $query = "INSERT INTO book_items (book_name, book_cover, pdf_path, book_details, book_cat_id) 
              VALUES ('$book_name', '$book_cover', '$pdf_path', '$book_details', '$book_cat_id')";
    
    if (!empty($book_cover) && !empty($pdf_path) && mysqli_query($connect, $query)) {
        echo "Book added successfully!";
    } else {
        echo "Error: $book_cover<br>$pdf_path<br>" . mysqli_error($connect);
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM book_items WHERE id = '$delete_id'";
    if (mysqli_query($connect, $delete_query)) {
        echo "Book deleted successfully!";
        header("Refresh: 1;url=/admin.php?page=books");
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
$categories = mysqli_query($connect, "SELECT * FROM book_cats");

$books_query = "SELECT bi.id, bi.book_name, bi.book_cover, bi.pdf_path, bi.book_details, bc.cat_name 
                FROM book_items bi 
                JOIN book_cats bc ON bi.book_cat_id = bc.id";
$books_result = mysqli_query($connect, $books_query);

?>

<div class="container">
    <h2 class="head">Add New Book</h2>
    <form method="POST"  enctype="multipart/form-data" class="admin-form">
        <div class="form-group">
            <label for="book_name">Book Name:</label>
            <input type="text" name="book_name" id="book_name" required>
        </div>
        <div class="form-group">
            <label for="book_cover">Book Cover Image:</label>
            <input type="file" name="book_cover" id="book_cover" required>
        </div>
        <div class="form-group">
            <label for="pdf_file">PDF File:</label>
            <input type="file" name="pdf_file" id="pdf_file" accept=".pdf" required>
        </div>
        <div class="form-group">
            <label for="book_details">Book Details:</label>
            <textarea name="book_details" id="book_details" required></textarea>
        </div>
        <div class="form-group">
            <label for="book_cat_id">Category:</label>
            <select name="book_cat_id" id="book_cat_id" required>
                <?php while ($row = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['cat_name']); ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn">Add Book</button>
    </form>

    <h2 class="head">Books List</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Book Name</th>
                <th>Cover Image</th>
                <th>PDF File</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($book = mysqli_fetch_assoc($books_result)) { ?>
                <tr>
                    <td><?php echo $book['id']; ?></td>
                    <td><?php echo htmlspecialchars($book['book_name']); ?></td>
                    <td>
                        <?php if ($book['book_cover']) { ?>
                            <img src="<?php echo $book['book_cover']; ?>" alt="<?php echo htmlspecialchars($book['book_name']); ?>" style="width: 50px; height: auto;">
                        <?php } ?>
                    </td>
                    <td>
                        <a href="<?php echo $book['pdf_path']; ?>" target="_blank">View PDF</a>
                    </td>
                    <td><?php echo htmlspecialchars($book['cat_name']); ?></td>
                    <td>
                        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $book['id']; ?>)">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this book?")) {
        window.location.href = "?page=books&delete_id=" + id;
    }
}
</script>
