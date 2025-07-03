<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
</head>
<body>
    <h1>Hoş Geldiniz, <?= htmlspecialchars($_SESSION['username']); ?></h1>
    <a href="t_ekle.html">Tarif Ekle</a>
    <a href="logout.php">Çıkış Yap</a>
</body>
</html>
