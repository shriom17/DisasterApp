<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "charity_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $charity_name = $_POST["charity_name"];
    $address = $_POST["address"];
    $mobile = $_POST["mobile"];
    $state = $_POST["state"];


    $sql = "INSERT INTO charity_form (name, email, charity_name, address, mobile, state)
            VALUES ('$name', '$email', '$charity_name', '$address', '$mobile', '$state')";

    if ($conn->query($sql) === TRUE) {
        echo "Charity information submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
