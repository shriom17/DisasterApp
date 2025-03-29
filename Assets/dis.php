<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $disasterType = htmlspecialchars($_POST['disaster-type']);
    $location = htmlspecialchars($_POST['location']);
    $description = htmlspecialchars($_POST['description']);

    echo "<h1>Disaster Report Submitted</h1>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Disaster Type:</strong> $disasterType</p>";
    echo "<p><strong>Location:</strong> $location</p>";
    echo "<p><strong>Description:</strong> $description</p>";
    echo "<p>Thank you for reporting the disaster. Your information will help us respond effectively.</p>";
} else {
    echo "<h1>Error</h1>";
    echo "<p>Invalid request. Please submit the form from the <a href='dis.html'>Disaster Dashboard</a>.</p>";
}
