<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disaster_app";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $confirm_pass = $_POST["confirm-password"];


    if ($pass !== $confirm_pass) {
        echo "Passwords do not match!";
    } else {

        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hashed_pass')";

        if ($conn->query($sql) === TRUE) {
            echo "Sign-up successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
