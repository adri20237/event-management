<?php
session_start();
include 'db.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM events');
$stmt->execute();
$events = $stmt->fetchAll();
?> <!DOCTYPE html>
<html>
<head>
    <title>Event Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
            <a href="create.php">Create Event</a>
            <a href="update_password.php">Update Password</a>
            <a href="logout.php">Logout</a>
            <h2>Events</h2>
            <ul>
                <?php foreach ($events as $event): ?>
                    <li>
                        <a href="edit.php?id=<?php echo $event['id']; ?>"><?php echo $event['name']; ?></a>
                        <form action="delete.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                        <p><?php echo $event['description']; ?></p>
                        <p>Date: <?php echo $event['date']; ?></p>
                        <p>Location: <?php echo $event['location']; ?></p>
                        <p>Assigned to: <?php echo $event['assigned_to']; ?></p>
                        <a href="edit.php?id=<?php echo $event['id']; ?>">Edit Event</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
