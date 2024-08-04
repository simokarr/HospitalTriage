<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "Pampampam1"; // Your MySQL password
$dbname = "hospital_triage";
$port = 3306; // Replace with your custom port if necessary

// Create connection
$conn = new mysqli($servername, $username, $password, "", $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create patients table
$sql = "CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code CHAR(3) NOT NULL,
    severity INT NOT NULL,
    wait_time INT NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'patients' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
