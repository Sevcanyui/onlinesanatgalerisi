<?php
include 'db_connect.php';
session_start();


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}


$users = $pdo->query("SELECT id, username, role FROM users")->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Kullanıcı Yönetimi</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Kullanıcılar</h2>

<?php foreach ($users as $u): ?>
  <div style="margin-bottom:10px">
    <?= htmlspecialchars($u['username']) ?> 
    (<?= $u['role'] ?>)

    <?php if ($u['role'] === 'user'): ?>
      <a href="make_admin.php?id=<?= $u['id'] ?>"
         onclick="return confirm('Admin yapılsın mı?')">
         ⭐ Admin Yap
      </a>
    <?php endif; ?>
  </div>
<?php endforeach; ?>

</body>
</html>


