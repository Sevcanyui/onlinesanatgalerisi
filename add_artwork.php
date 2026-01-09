<?php
include 'db_connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $artist_link = $_POST['artist_link'] ?? null;
    $description = $_POST['description'];
    $tags = $_POST['tags'] ?? null;

 
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            'uploads/' . $image
        );
    }

    $userId = $_SESSION['user']['id'];
    $status = ($_SESSION['user']['role'] === 'admin') ? 'approved' : 'pending';

    $stmt = $pdo->prepare("
        INSERT INTO artworks 
        (title, artist, artist_link, description, tags, image, status, user_id, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    $stmt->execute([
        $title,
        $artist,
        $artist_link,
        $description,
        $tags,
        $image,
        $status,
        $userId
    ]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Eser Ekle</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container">
<h2>Yeni Eser Ekle</h2>

<form method="post" enctype="multipart/form-data">

    <label>Başlık:</label>
    <input type="text" name="title" required>

    <label>Sanatçı:</label>
    <input type="text" name="artist" required>

    <label>Sanatçı Profil Linki:</label>
    <input 
        type="url" 
        name="artist_link"
        placeholder="https://instagram.com/kullaniciadi"
    >

    <label>Açıklama:</label>
    <textarea name="description"></textarea>

    <label>Etiketler:</label>
    <input type="text" name="tags" placeholder="#karakalem #dijital">

    <label>Görsel:</label>
    <input type="file" name="image" id="imageInput">

    <img id="preview" style="max-width:200px; margin-top:10px; display:none;">

    <button type="submit">Ekle</button>

</form>
</div>

<script>
document.getElementById('imageInput').onchange = function (e) {
    const file = e.target.files[0];
    if (file) {
        const img = document.getElementById('preview');
        img.src = URL.createObjectURL(file);
        img.style.display = 'block';
    }
};
</script>

</body>
</html>

