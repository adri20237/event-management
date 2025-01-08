<?php
include 'db.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE username = ?');
    $stmt->execute([md5($_POST['new_password']), $_SESSION['username']]);
    echo 'Password updated successfully!';
}
?> <!DOCTYPE html>
<html>
<head>
    <title>Update Password</title>
    <link rel="stylesheet" type="text/css" href="src/style.css">
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>Update Password</h1>
            <form action="src/update_password.php" method="post">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <button type="submit">Update Password</button>
            </form>
            <p><a href="src/index.php">Go back to events</a></p>
        </div>
    </div>
</body>
</html>

