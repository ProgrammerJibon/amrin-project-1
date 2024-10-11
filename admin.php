<?php
require_once 'config.php';

if (isset($user_info['role']) && $user_info['role'] === 'ADMIN') {
} else {
    header('Location: login.php');
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'users';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
<div class="nav-header">
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($user_info['full_name']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user_info['email']); ?></p>
</div>
<nav class="admin-nav">
    <ul class="nav-list">
        <li class="nav-item"><a href="/" class="<?php echo ($page === '') ? 'active' : ''; ?>">Home</a></li>
        <li class="nav-item"><a href="?page=users" class="<?php echo ($page === 'users') ? 'active' : ''; ?>">View Users</a></li>
        <li class="nav-item"><a href="?page=categories" class="<?php echo ($page === 'categories') ? 'active' : ''; ?>">Categories</a></li>
        <li class="nav-item"><a href="?page=books" class="<?php echo ($page === 'books') ? 'active' : ''; ?>">Books</a></li>
        <li class="nav-item"><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="admin-content">
    <?php
    switch ($page) {
        case 'categories':
            require_once 'add_categories.php';
            break;
        case 'books':
            require_once 'add_books.php';
            break;
        default:
            require_once 'view_users.php';
            break;
    }
    ?>
</div>

</body>
</html>
