<?php
include 'db.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO events (name, description, date, location, assigned_to) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$_POST['name'], $_POST['description'], $_POST['date'], $_POST['location'], $_POST['assigned_to']]);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
</head>
<body>
    <h1>Create Event</h1>
    <form action="create.php" method="post">
        <label for="name">Event Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>
        <label for="assigned_to">Assigned To:</label>
        <input type="text" id="assigned_to" name="assigned_to" required><br>
        <button type="submit">Create</button>
    </form>
</body>
</html>
 
