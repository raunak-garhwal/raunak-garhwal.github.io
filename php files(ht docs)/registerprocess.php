<?php

$server = "localhost";
$username = "root";
$pwd = "";
$dbname = "travel_app_data";
$errors = array();
$user = "";

// Connect to MySQL server
$conn = mysqli_connect($server, $username, $pwd);

if (!$conn) {
    error_log("Database Connection Failed: " . mysqli_connect_error());
    exit();
}

// Check if the database exists, if not, create it
$db_check = mysqli_select_db($conn, $dbname);
if (!$db_check) {
    $create_db = "CREATE DATABASE $dbname";
    if (!mysqli_query($conn, $create_db)) {
        error_log("Error creating database: " . mysqli_error($conn));
        exit();
    }
}

// Select the database
mysqli_select_db($conn, $dbname);

// Create the table if it doesn't exist
$table_check_query = "SHOW TABLES LIKE 'registered_users'";
$table_check = mysqli_query($conn, $table_check_query);
if (mysqli_num_rows($table_check) == 0) {
    $create_table_query = "
        CREATE TABLE registered_users (
            `S_no` INT NOT NULL AUTO_INCREMENT,
            `Username` VARCHAR(40) NOT NULL,
            `E-mail` VARCHAR(30) NOT NULL,
            `Password` VARCHAR(255) NOT NULL,
            `Mobile_no.` BIGINT(15) NOT NULL,
            `Registered_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`S_no`)
        )";
    
    if (!mysqli_query($conn, $create_table_query)) {
        error_log("Error creating table: " . mysqli_error($conn));
        exit();
    }
}

// Handle user registration
if (isset($_POST['register'])) {
    // Sanitize inputs
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $mobileno = htmlspecialchars($_POST['mobileno']);

    // Check if the user already exists
    $sql_check_query = "SELECT * FROM `registered_users` WHERE `Username` = ? OR `E-mail` = ? OR `Mobile_no.` = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql_check_query);
    mysqli_stmt_bind_param($stmt, "ssi", $fullname, $email, $mobileno); // Bind parameters
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if (($user['Username'] === $fullname) && ($user['E-mail'] === $email) && ($user['Mobile_no.'] === $mobileno)) {
            echo "<script>alert('You are already registered.\\nYou just need to log in.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/loginform/loginform.html','_self')</script>";
        } elseif ($user['Username'] === $fullname) {
            echo "<script>alert('Username already exists.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/registrationform/registrationform.html','_self')</script>";
        } elseif ($user['E-mail'] === $email) {
            echo "<script>alert('Email already exists.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/registrationform/registrationform.html','_self')</script>";
        } elseif ($user['Mobile_no.'] === $mobileno) {
            echo "<script>alert('Mobile number already exists.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/registrationform/registrationform.html','_self')</script>";
        }
    }

    // If no errors, hash the password and insert the user into the database
    if (count($errors) === 0 && !$user) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

        $sql = "INSERT INTO `registered_users`(`Username`, `E-mail`, `Password`, `Mobile_no.`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $fullname, $email, $hashed_password, $mobileno); // Bind parameters
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>alert('Congratulations, You have successfully registered with TravelU.\\nPlease Login to Continue.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/loginform/loginform.html','_self')</script>";
        } else {
            echo "Some error occurred, data cannot be submitted: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);

?>
