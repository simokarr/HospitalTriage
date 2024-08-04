<?php
include('db.php');

// Fetch all patients
$result = $conn->query("SELECT * FROM patients ORDER BY severity DESC, wait_time ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Triage System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Hospital Triage System</h1>

    <h2>Check Your Wait Time</h2>
    <form method="get">
        <label>Enter Your Name or Code:</label>
        <input type="text" name="query" required>
        <input type="submit" value="Check">
    </form>

    <?php
    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        $stmt = $conn->prepare("SELECT * FROM patients WHERE name LIKE ? OR code = ?");
        $query_like = "%$query%";
        $stmt->bind_param("ss", $query_like, $query);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h3>Search Results:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . htmlspecialchars($row['name']) . " (" . htmlspecialchars($row['code']) . "): " . htmlspecialchars($row['wait_time']) . " minutes</p>";
            }
        } else {
            echo "<p>No results found.</p>";
        }
        $stmt->close();
    }
    ?>

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
</body>
</html>

<?php $conn->close(); ?>
