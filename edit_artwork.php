<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM artworks WHERE id = ?");
$stmt->execute([$id]);
$art = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $description = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
    } else {
        $image = $art['image'];
    }

    $stmt = $pdo->prepare("UPDATE artworks SET title=?, artist=?, description=?, image=? WHERE id=?");
    $stmt->execute([$title, $artist, $description, $image, $id]);

    header("Location: admin_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Eseri Düzenle</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="form-container">
<h2>Eseri Düzenle</h2>
<form method="post" enctype="multipart/form-data">
    <label>Başlık:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($art['title']) ?>" required>
    <label>Sanatçı:</label>
    <input type="text" name="artist" value="<?= htmlspecialchars($art['artist']) ?>" required>
    <label>Açıklama:</label>
    <textarea name="description"><?= htmlspecialchars($art['description']) ?></textarea>
    <label>Yeni Görsel (isteğe bağlı):</label>
    <input type="file" name="image">
    <button type="submit">Kaydet</button>
</form>
</div>
</body>
</html>

