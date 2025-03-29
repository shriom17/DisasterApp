<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $amount = htmlspecialchars($_POST['amount']);
    $card = htmlspecialchars($_POST['card']);

    if (!empty($name) && !empty($amount) && !empty($card)) {
        echo "<h1>Thank you, $name!</h1>";
        echo "<p>Your donation of INR $amount has been successfully processed.</p>";
        echo "<p>We appreciate your support in helping us provide relief during disasters.</p>";
    } else {
        echo "<h1>Error</h1>";
        echo "<p>All fields are required. Please go back and fill out the form completely.</p>";
    }
} else {
    header("Location: charity.html");
    exit();
}
