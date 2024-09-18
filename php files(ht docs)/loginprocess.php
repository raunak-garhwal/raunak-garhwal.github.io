<?php

$server = "localhost";
$un = "root";
$pwd = "";
$dbname = "travel_app_data";
$errors = array();
$user = "";

// Connect to MySQL
$conn = mysqli_connect($server, $un, $pwd, $dbname);

if (!$conn) {
    error_log("Database Not Connected: " . mysqli_connect_error());
    exit();
}

// Handle user login
if (isset($_POST['login'])) {
    // Sanitize inputs
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Prepared statement to check user existence
    $sql_check_query = "SELECT `Username`, `Password` FROM `registered_users` WHERE `Username` = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql_check_query);
    mysqli_stmt_bind_param($stmt, "s", $username); // Bind the username parameter
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
}

if ($user) {
    // Verify password
    if (password_verify($password, $user['Password'])) {
        // Successful login, redirect to the home page
        echo "<script>alert('Login Successful.\\nGo back to the Home Page.')</script>";
        echo "<script>window.open('http://raunak-garhwal.github.io/loginpage/loginpage.html','_self')</script>";
        exit();
    } elseif ($user['Username'] === $username) {
        // Incorrect password
        echo "<script>alert('Incorrect Password')</script>";
        echo "<script>window.open('http://raunak-garhwal.github.io/loginform/loginform.html','_self')</script>";
        exit();
    }
} else {
    // Username not found
    echo "<script>alert('Note : You have not registered with TravelU.\\nPlease Register yourself first.')</script>";
    echo "<script>window.open('http://raunak-garhwal.github.io/registrationform/registrationform.html','_self')</script>";
    exit();
}

// Close the database connection
mysqli_close($conn);

?>
