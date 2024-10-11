<?php
require_once "./config.php"; // Include the database connection and session logic

// If the user is already logged in, redirect them to the homepage
if (isset($user_info['id'])) {
    header("Location: /");
    exit();
}

// Initialize variables for feedback messages
$feedback = "";
$feedback_class = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $password = mysqli_real_escape_string($connect, $_POST['pass']);

    // Validation
    if (empty($email) || empty($password)) {
        $feedback = "Both fields are required!";
        $feedback_class = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $feedback = "Invalid email format!";
        $feedback_class = "error";
    } else {
        // Hash the password with md5(sha1())
        $hashed_password = md5(sha1($password));

        // Check user credentials
        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$hashed_password' LIMIT 1";
        $result = mysqli_query($connect, $login_query);

        if (mysqli_num_rows($result) > 0) {
            // Fetch user data and store session
            $user_info = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user_info['id'];

            // Redirect to homepage after successful login
            header("Location: /");
            exit();
        } else {
            $feedback = "Invalid email or password!";
            $feedback_class = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .login-container {
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
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 8px 0 20px 0;
            border: 1px solid #cccccc;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #66afe9;
            outline: none;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 14px 0;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
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

<div class="login-container">
    <h2>Login</h2>

    <!-- Feedback Message -->
    <?php if (!empty($feedback)): ?>
        <div class="feedback <?php echo $feedback_class; ?>">
            <?php echo htmlspecialchars($feedback); ?>
        </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        <input type="password" name="pass" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>

    <div><br><center>or</center></div>

    <!-- Link to Sign Up -->
    <div class="signup-link">
        <a href="/" class="signup-button">Go Home</a>
        <a href="/signup.php" class="signup-button">Create an account</a>
    </div>
</div>

</body>
</html>
