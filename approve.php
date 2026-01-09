<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: admin_dashboard.php");
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE artworks SET status = 'approved' WHERE id = ?"
);
$stmt->execute([$id]);

header("Location: admin_dashboard.php");
exit;
