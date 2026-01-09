<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user']['id'];

$stmt = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Bildirimler</title>
<link rel="stylesheet" href="styles.css">
<style>
body {
    background: #0f271e;
    font-family: Arial, sans-serif;
    color: white;
}

.notifications-container {
    width: 80%;
    max-width: 600px;
    margin: 30px auto;
}

.notification-box {
    background: #154531;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 10px;
}
</style>
</head>
<body>

<div class="notifications-container">
    <h2>Bildirimler</h2>

    <?php if (empty($notifications)): ?>
        <p>Henüz bildirim bulunmuyor.</p>
    <?php else: ?>
        <?php foreach ($notifications as $n): ?>
            <div class="notification-box">
                <?= htmlspecialchars($n['message']) ?><br>
                <small><?= $n['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
