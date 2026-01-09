<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Onay bekleyenler
$stmtPending = $pdo->query(
    "SELECT * FROM artworks WHERE status = 'pending' ORDER BY created_at DESC"
);
$pendingArtworks = $stmtPending->fetchAll(PDO::FETCH_ASSOC);

// Onaylanmışlar
$stmtApproved = $pdo->query(
    "SELECT * FROM artworks WHERE status = 'approved' ORDER BY created_at DESC"
);
$approvedArtworks = $stmtApproved->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Yönetim Paneli</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1> Yönetim Paneli</h1>
    <nav>
        <a href="add_artwork.php">Yeni Eser Ekle</a>
        <a href="index.php">Siteye Git</a>
        <a href="logout.php">Çıkış</a>
		<a href="admin_users.php"> Kullanıcı Yönetimi</a>

    </nav>
</header>
<main>
	<h2>Onay Bekleyen Eserler</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Başlık</th>
        <th>Sanatçı</th>
        <th>İşlemler</th>
    </tr>
    <?php foreach ($pendingArtworks as $a): ?>
    <tr>
        <td><?= $a['id'] ?></td>
        <td><?= htmlspecialchars($a['title']) ?></td>
        <td><?= htmlspecialchars($a['artist']) ?></td>
        <td>
            <a href="approve_artwork.php?id=<?= $a['id'] ?>">Onayla</a> |
            <a href="delete_artwork.php?id=<?= $a['id'] ?>"
               onclick="return confirm('Reddetmek istiyor musunuz?')">
               Reddet
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
		<h2>Yayındaki (Onaylanmış) Eserler</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Başlık</th>
        <th>Sanatçı</th>
        <th>İşlemler</th>
    </tr>
    <?php foreach ($approvedArtworks as $a): ?>
    <tr>
        <td><?= $a['id'] ?></td>
        <td><?= htmlspecialchars($a['title']) ?></td>
        <td><?= htmlspecialchars($a['artist']) ?></td>
        <td>
            <a href="edit_artwork.php?id=<?= $a['id'] ?>">Düzenle</a> |
            <a href="delete_artwork.php?id=<?= $a['id'] ?>"
               onclick="return confirm('Silinsin mi?')">
               Sil
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</main>
</body>
</html>
