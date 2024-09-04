<?php
require 'includes/db.php';
require 'includes/auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM santri WHERE id = ?");
$stmt->execute([$id]);

header('Location: list_santri.php');
exit();
?>
