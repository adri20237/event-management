<?php
include 'db.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs to prevent unintended issues
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $date = trim($_POST['date']);
    $location = trim($_POST['location']);
    $assigned_to = trim($_POST['assigned_to']);
    $id = trim($_POST['id']);

    // Debugging: log the values to confirm they're being processed correctly
    error_log("Updating Event - ID: $id, Name: $name, Location: $location");

    try {
        // Prepare and execute the update query
        $stmt = $pdo->prepare('UPDATE events SET name = ?, description = ?, date = ?, location = ?, assigned_to = ? WHERE id = ?');
        $stmt->execute([$name, $description, $date, $location, $assigned_to, $id]);

        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        // Log the error for debugging
        error_log("Error updating event: " . $e->getMessage());
        echo "Error updating event: " . htmlspecialchars($e->getMessage());
    }
} else {
    try {
        // Fetch the existing event data
        $stmt = $pdo->prepare('SELECT * FROM events WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $event = $stmt->fetch();
    } catch (PDOException $e) {
        // Log and display the error
        error_log("Error fetching event: " . $e->getMessage());
        echo "Error fetching event: " . htmlspecialchars($e->getMessage());
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event</h1>
    <form action="edit.php" method="post" accept-charset="UTF-8">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($event['id']); ?>">
        <label for="name">Event Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($event['name']); ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($event['description']); ?></textarea><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($event['date']); ?>" required><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($event['location']); ?>" required><br>
        <label for="assigned_to">Assigned To:</label>
        <input type="text" id="assigned_to" name="assigned_to" value="<?php echo htmlspecialchars($event['assigned_to']); ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
