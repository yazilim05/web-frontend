<?php

require 'config.php'; 


$stmt = $pdo->query("SELECT * FROM tarifler ORDER BY id DESC");
$tarifler = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .navbar, .bg-success {
            background-color: #28a745 !important; 
        }

        .navbar-brand, .nav-link, footer p {
            color: white !important; 
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        
        .text-success {
            color: #28a745 !important;
        }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-success">
    <div class="container">
        <a class="navbar-brand text-white" href="sablon.html">Yemek Tarifim</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-white" href="sablon.html">Ana Sayfa</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="tarifler.php">Tarifler</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="tarifekle.php">Tarif Ekle</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="hakkında.html">Hakkında</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container my-5">
    <h2 class="text-center text-success">Tarifler</h2>
    <p class="text-center text-muted">Siteye eklenen tarifler.</p>

    <div class="row">
        <?php foreach ($tarifler as $tarif): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    
                    <img src="uploads/<?= htmlspecialchars($tarif['resim']) ?: 'default.jpg' ?>" class="card-img-top" alt="Tarif Resmi">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($tarif['tarif_adi']); ?></h5>
                        <p class="card-text"><strong>Kategori:</strong> <?= htmlspecialchars($tarif['kategori']); ?></p>
                        <a href="tarifdetay.php?id=<?= $tarif['id']; ?>" class="btn btn-success">Tarifi Görüntüle</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<footer class="bg-success text-white text-center py-3">
    <p>&copy; 2024 Yemek Tarifim | Tüm hakları saklıdır.</p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
