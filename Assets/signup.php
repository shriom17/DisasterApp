<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    echo "<h1>Sign-Up Successful</h1>";
    echo "<p><strong>Username:</strong> $username</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p>Your account has been created successfully!</p>";
} else {
    echo "<h1>Error</h1>";
    echo "<p>Invalid request. Please submit the form from the <a href='signup.html'>Sign-Up Page</a>.</p>";
}
