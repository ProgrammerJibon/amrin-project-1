<?php
require_once "./config.php"; // Include the database connection and session logic

// If the user is already logged in, redirect them to the homepage
if (isset($user_info['id'])) {
    header("Location: /"); // Redirect to the homepage
    exit();
}

// Initialize variables for feedback messages
$feedback = "";
$feedback_class = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $full_name = mysqli_real_escape_string($connect, trim($_POST['full_name']));
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $password = mysqli_real_escape_string($connect, $_POST['pass']);

    // Validation
    if (empty($full_name) || empty($email) || empty($password)) {
        $feedback = "All fields are required!";
        $feedback_class = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $feedback = "Invalid email format!";
        $feedback_class = "error";
    } else {
        // Hash password using md5(sha1())
        $hashed_password = md5(sha1($password));

        // Check if email already exists
        $check_email_query = "SELECT * FROM users WHERE email='$email'";
        $check_result = mysqli_query($connect, $check_email_query);

        if (mysqli_num_rows($check_result) > 0) {
            $feedback = "Email already exists!";
            $feedback_class = "error";
        } else {
            // Insert data into users table
            $insert_query = "INSERT INTO `users` (`full_name`, `email`, `password`, `time`) 
                             VALUES ('$full_name', '$email', '$hashed_password', $time)";

            if (mysqli_query($connect, $insert_query)) {
                // Fetch the newly inserted user's ID
                $user_id = mysqli_insert_id($connect);

                // Store user session
                $_SESSION['user_id'] = $user_id;

                // Retrieve and store user information in $user_info
                $user_info_query = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
                $user_info_result = mysqli_query($connect, $user_info_query);
                $user_info = mysqli_fetch_assoc($user_info_result);

                // Redirect to homepage after successful signup and login
                header("Location: /");
                exit();
            } else {
                $feedback = "Error: " . mysqli_error($connect);
                $feedback_class = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        /* CSS Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-container {
            background-color: #ffffff;
            padding: 30px 40px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 12px;
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 8px 0 20px 0;
            border: 1px solid #cccccc;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            border-color: #66afe9;
            outline: none;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #2883a7;
            color: white;
            padding: 14px 0;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .feedback {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
        }
        .feedback.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .feedback.success {
            background-color: #d4edda;
            color: #155724;
        }

        .signup-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        .signup-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .signup-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Create an Account</h2>

    <!-- Feedback Message -->
    <?php if (!empty($feedback)): ?>
        <div class="feedback <?php echo $feedback_class; ?>">
            <?php echo htmlspecialchars($feedback); ?>
        </div>
    <?php endif; ?>

    <!-- Signup Form -->
    <form action="signup.php" method="POST">
        <input type="text" name="full_name" placeholder="Full Name" value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        <input type="password" name="pass" placeholder="Password" required>
        <input type="submit" value="Sign Up">
    </form>

    
    <div><br><center>or</center></div>

    <!-- Link to Sign Up -->
    <div class="signup-link">
        <a href="/" class="signup-button">Go Home</a>
        <a href="/login.php" class="signup-button">Login with account</a>
    </div>
</div>

</body>
</html>
