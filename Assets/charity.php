<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $charityName = htmlspecialchars($_POST['charity_name']);
    $address = htmlspecialchars($_POST['address']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $state = htmlspecialchars($_POST['state']);

    echo "<h1>Charity Form Submitted</h1>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Charity Name:</strong> $charityName</p>";
    echo "<p><strong>Address:</strong> $address</p>";
    echo "<p><strong>Mobile No.:</strong> $mobile</p>";
    echo "<p><strong>State:</strong> $state</p>";
    echo "<p>Thank you for submitting your details. We will contact you soon.</p>";
} else {
    echo "<h1>Error</h1>";
    echo "<p>Invalid request. Please submit the form from the <a href='charity.html'>Charity Page</a>.</p>";
}
