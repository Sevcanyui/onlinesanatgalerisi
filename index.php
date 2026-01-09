<?php
include 'db_connect.php';
session_start();

$stmt = $pdo->query("SELECT * FROM artworks WHERE status = 'approved' ORDER BY created_at DESC");
$artworks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Online Sanat Galerisi</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <h1>Online Sanat Galerisi</h1>
    <nav>
        <a class="btn" href="notifications.php">
            <i class="fa-regular fa-bell"></i> Bildirimler
        </a>
        <a href="add_artwork.php">Eser Yükle</a>

        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Çıkış Yap</a>
            <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                <a href="admin_dashboard.php">Yönetim Paneli</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="login.php">Giriş</a>
            <a href="register.php">Kayıt Ol</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <h2>Sanat Eserleri</h2>

    <div class="gallery">
        <?php foreach ($artworks as $art): ?>
            <div class="art-card">

<!-- SADECE RESİM TIKLANABİLİR -->
<a href="artwork.php?id=<?= $art['id'] ?>" class="image-link">
    <div class="image-box">
        <img src="uploads/<?= htmlspecialchars($art['image']) ?>" alt="">
    </div>
</a>

                <!-- BAŞLIK TIKLANMAZ -->
                <h3><?= htmlspecialchars($art['title']) ?></h3>

                <p><b>Sanatçı:</b> <?= htmlspecialchars($art['artist']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
	
</main>
</body>
</html>
