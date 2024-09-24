<?php
$server = "localhost";
$un = "root";
$pwd = "";
$dbname = "travel_app_data";

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
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Verify plain text password
        if ($password === $user['Password']) {
            echo "<script>alert('Login Successful.\\nRedirecting to the Home Page.'); window.location.href = 'http://raunak-garhwal.github.io/loginpage/loginpage.html';</script>";
        } else {
            echo "<script>alert('Incorrect Password'); window.location.href = 'http://raunak-garhwal.github.io/loginform/loginform.html';</script>";
        }
    } else {
        echo "<script>alert('User not found. Please register first.'); window.location.href = 'http://raunak-garhwal.github.io/registrationform/registrationform.html';</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
