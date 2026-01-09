<?php
include 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        $error = "E-posta veya parola hatalı!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Giriş Yap</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="form-container">
<h2>Giriş Yap</h2>
<form method="post">
    <label>E-posta:</label>
    <input type="email" name="email" required>
    <label>Parola:</label>
    <input type="password" name="password" required>
    <button type="submit">Giriş</button>
</form>
<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
</div>
</body>
</html>
