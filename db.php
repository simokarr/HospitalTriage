<?php
$servername = "localhost";
$username = "root"; // replace with your MySQL username
$password = "Pampampam1"; // replace with your MySQL password
$dbname = "hospital_triage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>