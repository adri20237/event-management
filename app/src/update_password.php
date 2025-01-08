<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE username = ?');
    $stmt->execute([md5($_POST['new_password']), $_POST['username']]);
    echo 'Password updated successfully! <a href="login.php">Login here</a>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>Update Password</h1>
            <form action="update_password.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <button type="submit">Update Password</button>
            </form>
            <p><a href="login.php">Back to login</a></p>
        </div>
    </div>
</body>
</html>
