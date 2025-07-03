<?php
session_start();
require 'config.php';

// Admin kontrolü
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php"); // Admin değilse login sayfasına yönlendir
    exit;
}

// Kullanıcıyı silmek için id kontrolü
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Kullanıcıyı veritabanından sil
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    // Kullanıcı silindikten sonra kullanıcı listeleme sayfasına yönlendir
    header("Location: kullanıcılistele.php");
    exit;
} else {
    // Geçersiz ID durumu
    header("Location: kullanıcılistele.php");
    exit;
}
?>

