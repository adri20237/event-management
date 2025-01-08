<?php
include 'db.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM events');
$stmt->execute();
$events = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($events);
?>
 
