
<?php

$host = 'localhost';
$dbname = 'disaster_db';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $state = $_POST['state'];

    $stmt = $conn->prepare("INSERT INTO user_messages (name, email, message, address, mobile, state) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $message, $address, $mobile, $state);

    if ($stmt->execute()) {
        echo "Your data has been saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
