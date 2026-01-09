<?php
include 'db_connect.php';
session_start();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM artworks WHERE id = ? AND status = 'approved'");
$stmt->execute([$id]);
$art = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$art) {
    echo "Eser bulunamadı.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($art['title']) ?></title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Online Sanat Galerisi</h1>
    <nav>
        <a href="index.php">Ana Sayfa</a>
    </nav>
</header>

<main class="art-detail">


    <div class="art-detail-container">
        <div class="art-detail-image">
            <img src="uploads/<?= htmlspecialchars($art['image']) ?>" alt="">
        </div>

        <div class="art-detail-info">
            <h2><?= htmlspecialchars($art['title']) ?></h2>
            <p><strong>Sanatçı:</strong> <?= htmlspecialchars($art['artist']) ?></p>
            <p><?= nl2br(htmlspecialchars($art['description'])) ?></p>
			<?php if (!empty($art['artist_link'])): ?>
    <p>
        <strong>Sanatçı Profili:</strong>
        <a 
href="<?= htmlspecialchars($art['artist_link']) ?>" 
target="_blank"
style="
    color:#a3ffd4;
    text-decoration: underline;
    text-decoration-thickness: 2px;
    text-underline-offset: 4px;
    font-weight: 600;
"
>
    Profili Gör
</a>

    </p>
<?php endif; ?>

        </div>
    </div>

</main>

</body>
</html>
