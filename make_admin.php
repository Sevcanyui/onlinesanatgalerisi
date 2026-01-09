<?php
include 'db_connect.php';
session_start();

/* Admin değilse yasak */
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

/* Admin yap */
$stmt = $pdo->prepare("UPDATE users SET role = 'admin' WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin_users.php");
exit;
