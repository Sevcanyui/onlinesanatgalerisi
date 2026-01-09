<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$artworkId = $_GET['id'];

$stmt = $pdo->prepare("SELECT user_id FROM artworks WHERE id = ?");
$stmt->execute([$artworkId]);
$artwork = $stmt->fetch();

if ($artwork) {


    $pdo->prepare("UPDATE artworks SET status = 'rejected' WHERE id = ?")
        ->execute([$artworkId]);


    $pdo->prepare(
        "INSERT INTO notifications (user_id, message)
         VALUES (?, ?)"
    )->execute([
        $artwork['user_id'],
        '❌ Yüklediğiniz eser maalesef reddedildi.'
    ]);
}

header("Location: admin_dashboard.php");
exit;

