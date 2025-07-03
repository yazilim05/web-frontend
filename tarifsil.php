<?php
session_start();
require 'config.php';

// Admin kontrolü
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php"); // Admin değilse login sayfasına yönlendir
    exit;
}

// Tarif silme işlemi
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Tarifin bilgilerini alalım
    $stmt = $pdo->prepare("SELECT resim FROM tarifler WHERE id = ?");
    $stmt->execute([$id]);
    $tarif = $stmt->fetch(PDO::FETCH_ASSOC);

    // Tarifin resmini kontrol et ve sil
    if ($tarif && !empty($tarif['resim'])) {
        $resim_yolu = 'uploads/' . $tarif['resim']; // Resmin tam yolu
        if (file_exists($resim_yolu)) {
            unlink($resim_yolu); // Resmi sunucudan sil
        }
    }

    // Veritabanından tarifi sil
    $stmt = $pdo->prepare("DELETE FROM tarifler WHERE id = ?");
    $stmt->execute([$id]);

    // Başarılı şekilde silindikten sonra tarif liste sayfasına yönlendir
    header("Location: tariflistele.php");
    exit;
} else {
    // id parametresi yoksa tarif listeleme sayfasına yönlendir
    header("Location: tariflistele.php");
    exit;
}
?>

