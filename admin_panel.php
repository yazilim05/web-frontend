<?php
session_start();

// Hata raporlamayı açıyoruz
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Admin kullanıcı adı kontrolü
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php"); // Admin değilse login sayfasına yönlendir
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
</head>
<body>
    <h1>Admin Paneli</h1>
    <p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['username']); ?>! <a href="logout.php">Çıkış Yap</a></p>

    <h2>Yönetim Seçenekleri</h2>
    <ul>
        <li><a href="kullanıcılistele.php">Kullanıcıları Listele ve Sil</a></li>
        <li><a href="tariflistele.php">Tarifleri Listele ve Sil</a></li>
        <li><a href="tarifekle.php">Yeni Tarif Ekle</a></li>
    </ul>
</body>
</html>
