<?php

$server = "localhost";
$un = "root";
$pwd = "";
$dbname = "travel_app_data";
$errors = array();
$user = "";

$conn = mysqli_connect($server,$un,$pwd,$dbname);

if (!$conn){
    echo "Database Not Connected.";
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $sql_check_query = "SELECT `Username`,`Password` FROM `registered_users` WHERE `Username` = '$username' OR `Password` = '$password' LIMIT 1";
    $result = mysqli_query($conn,$sql_check_query);
    $user = mysqli_fetch_assoc($result);
}

if($user) {
    if (($user['Username'] === $username)and($user['Password'] === $password)) {
        // array_push($errors,"Username already exists");
        echo "<script>alert('Login Successful.\\nGo back to the Home Page.')</script>";
        echo "<script>window.open('http://raunak-garhwal.github.io/loginpage/loginpage.html','_self')</script>";
    }
      
    elseif ($user['Username'] != $username) {
        // array_push($errors,"Incorrect Password");
        echo "<script>alert('Incorrect Username')</script>";
        echo "<script>window.open('http://raunak-garhwal.github.io/loginform/loginform.html','_self')</script>";
    }
    
    elseif ($user['Password'] != $password) {
        // array_push($errors,"Incorrect Username");
        echo "<script>alert('Incorrect Password')</script>";
        echo "<script>window.open('http://raunak-garhwal.github.io/loginform/loginform.html','_self')</script>";
    }
    
}
else {
    echo "<script>alert('Note : You have not registered with TravelU.\\nPlease Register yourself first.')</script>";
    echo "<script>window.open('http://raunak-garhwal.github.io/registrationform/registrationform.html','_self')</script>";
}
mysqli_close($conn);
?>