<?php

$server = "localhost";
$username = "root";
$pwd = "";
$dbname = "travel_app_data";
$errors = array();
$user = "";

$conn = mysqli_connect($server,$username,$pwd,$dbname);

if (!$conn){
    die("Database Not Connected: " . mysqli_connect_error());
}

if(isset($_POST['register'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobileno = $_POST['mobileno'];

    $sql_check_query = "SELECT * FROM `registered_users` WHERE `Username` = '$fullname' OR `E-mail` = '$email' OR `Password` = '$password' OR `Mobile_no.` = '$mobileno' LIMIT 1";
    $result = mysqli_query($conn,$sql_check_query);
    $user = mysqli_fetch_assoc($result);

    if($user) {
        if (($user['Username'] === $fullname)AND($user['E-mail'] === $email)AND($user['Password'] === $password)AND($user['Mobile_no.'] === $mobileno)) {
            array_push($errors,"Username already exists");
            echo "<script>alert('You are already registered.\\nYou just need to login yourself.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/loginform/loginform.html','_self')</script>";
        }
        if ($user['Username'] === $fullname) {
            array_push($errors,"Username already exists");
            echo "<script>alert('Username already exists.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/registrationform/registrationform.html','_self')</script>";
        }
        if ($user['E-mail'] === $email) {
            array_push($errors,"E-mail already exists");
            echo "<script>alert('Email already exists.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/registrationform/registrationform.html','_self')</script>";
        }
        if ($user['Password'] === $password) {
            array_push($errors,"Password already exists");
            echo "<script>alert('Password already exists.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/registrationform/registrationform.html','_self')</script>";
        }
        if ($user['Mobile_no.'] === $mobileno) {
            array_push($errors,"Mobile_no. already exists");
            echo "<script>alert('Mobile_no. already exists.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/registrationform/registrationform.html','_self')</script>";
        }
    }

    if (count($errors) === 0) {
        $sql = "INSERT INTO `registered_users`(`Username`,`E-mail`,`Password`,`Mobile_no.`) VALUES ('$fullname','$email','$password','$mobileno');";

        $result = mysqli_query($conn, $sql);
    
        if ($result)
        {
            echo "<script>alert('Congratulations, You have successfully registered with TravelU.\\nPlease Login to Continue.')</script>";
            echo "<script>window.open('http://raunak-garhwal.github.io/loginform/loginform.html','_self')</script>";
            exit();   
        }
    
        else 
        {
            echo "Some error occurred, data cannot be submitted: " . mysqli_error($conn);
        }
    }

}
mysqli_close($conn);

?>

<!-- 
  Run this query in Xampp.  

CREATE DATABASE travel_app_data;
USE travel_app_data;
CREATE TABLE registered_users (`S_no` INT NOT NULL AUTO_INCREMENT , `Username` VARCHAR(40) NOT NULL , `E-mail` VARCHAR(30) NOT NULL , `Password` VARCHAR(20) NOT NULL , `Mobile_no.` BIGINT(15) NOT NULL , `Registered_on` TIMESTAMP NOT NULL , PRIMARY KEY (`S_no`));

 -->