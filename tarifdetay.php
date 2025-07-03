<?php
require 'config.php'; // Veritabanı bağlantısı

// Tarifin ID'sini alıyoruz
if (isset($_GET['id'])) {
    $tarif_id = $_GET['id'];

    // Veritabanından tarif detaylarını çekme
    $stmt = $pdo->prepare("SELECT * FROM tarifler WHERE id = ?");
    $stmt->execute([$tarif_id]);
    $tarif = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$tarif) {
    echo "Tarif bulunamadı!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarif Detayları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-success">
    <div class="container">
        <a class="navbar-brand text-white" href="sablon.html">Yemek Tarifim</a>
        <!-- Diğer navbar öğeleri -->
    </div>
</nav>

<!-- Tarif Detayları -->
<div class="container my-5">
    <h2 class="text-center text-success"><?= htmlspecialchars($tarif['tarif_adi']); ?></h2>
    <p class="text-center text-muted"><strong>Kategori:</strong> <?= htmlspecialchars($tarif['kategori']); ?></p>

    <div class="row">
        <div class="col-md-6">
            <!-- Resim göster -->
            <img src="uploads/<?= htmlspecialchars($tarif['resim']) ?: 'default.jpg' ?>" class="img-fluid" alt="Tarif Resmi">
        </div>
        <div class="col-md-6">
            <h4>Malzemeler</h4>
            <p><?= nl2br(htmlspecialchars($tarif['malzemeler'])); ?></p>
            <h4>Yapılış</h4>
            <p><?= nl2br(htmlspecialchars($tarif['yapilis'])); ?></p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3">
    <p>&copy; 2024 Yemek Tarifim | Tüm hakları saklıdır.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
