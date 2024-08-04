<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

include('db.php');

// Handle form submissions for adding patients
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $severity = $_POST['severity'];
    $wait_time = $_POST['wait_time'];

    $stmt = $conn->prepare("INSERT INTO patients (name, code, severity, wait_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $name, $code, $severity, $wait_time);
    $stmt->execute();
    $stmt->close();
}

// Fetch all patients
$result = $conn->query("SELECT * FROM patients ORDER BY severity DESC, wait_time ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Admin Panel</h1>
    <h2>Add New Patient</h2>
    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Code:</label>
        <input type="text" name="code" maxlength="3" required><br>
        <label>Severity:</label>
        <input type="number" name="severity" required><br>
        <label>Wait Time (mins):</label>
        <input type="number" name="wait_time" required><br>
        <input type="submit" value="Add Patient">
    </form>

    <h2>Current Patients</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Code</th>
            <th>Severity</th>
            <th>Wait Time</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['code']); ?></td>
            <td><?php echo htmlspecialchars($row['severity']); ?></td>
            <td><?php echo htmlspecialchars($row['wait_time']); ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>

<?php $conn->close(); ?>
