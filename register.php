<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
    $stmt->execute([$username, $email, $pass]);

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Kayıt Ol</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="form-container">
<h2>Kayıt Ol</h2>
<form method="post">
    <label>Kullanıcı Adı:</label>
    <input type="text" name="username" required>
    <label>E-posta:</label>
    <input type="email" name="email" required>
    <label>Parola:</label>
    <input type="password" name="password" required>
    <button type="submit">Kayıt Ol</button>
</form>
</div>
</body>
</html>
