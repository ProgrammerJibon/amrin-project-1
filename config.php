<?php
// Start the session
session_start();

date_default_timezone_set("Asia/Dhaka");

// Suppress error reporting for mysqli_connect and handle errors manually
$connect = @mysqli_connect("localhost", "root", "", "a_project");

// Check connection
if (!$connect) {
    exit("Unable to connect to database...");
}

// Set the current timestamp
$time = time();

// Initialize $user_info as an empty array
$user_info = [];

// Check if user is logged in by checking session data
if (isset($_SESSION['user_id'])) {
    // Retrieve the user's information from the database
    $user_id = $_SESSION['user_id'];
    $user_query = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
    $user_result = mysqli_query($connect, $user_query);
    
    if (mysqli_num_rows($user_result) > 0) {
        // Fetch user data and store it in $user_info
        $user_info = mysqli_fetch_assoc($user_result);
    } else {
        // If no user found, clear session
        session_unset();
        session_destroy();
    }
}


function upload($tmp_file, $type = false){
	$mime_file_type = explode("/", mime_content_type($tmp_file));
	$result = false;
	if($type == false || $type == $mime_file_type[0] || $type == $mime_file_type[1]){
		$file_path = "uploads/".date("Y/M/");
		if (!file_exists($file_path)) {
			mkdir($file_path, 0777, true);
		}
		$file_name = $file_path.$mime_file_type[0]."-".time()."-".rand().".".$mime_file_type[1];
		if(move_uploaded_file($tmp_file, $file_name)){
			$result = $file_name;
		}
	}
	return $result;
}