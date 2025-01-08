<?php
include 'db.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('UPDATE events SET name = ?, description = ?, date = ?, location = ?, assigned_to = ? WHERE id = ?');
    $stmt->execute([$_POST['name'], $_POST['description'], $_POST['date'], $_POST['location'], $_POST['assigned_to'], $_POST['id']]);
    header('Location: index.php');
    exit;
} else {
    $stmt = $pdo->prepare('SELECT * FROM events WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $event = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event</h1>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
        <label for="name">Event Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $event['name']; ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $event['description']; ?></textarea><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $event['date']; ?>" required><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $event['location']; ?>" required><br>
        <label for="assigned_to">Assigned To:</label>
        <input type="text" id="assigned_to" name="assigned_to" value="<?php echo $event['assigned_to']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
 
