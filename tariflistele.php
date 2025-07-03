<?php
session_start();
require 'config.php';

// Admin kontrolü
if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php"); // Admin değilse login sayfasına yönlendir
    exit;
}

// Tarifleri listele
$recipeStmt = $pdo->query("SELECT id, tarif_adi AS baslik, malzemeler, yapilis, resim FROM tarifler");
$recipes = $recipeStmt->fetchAll(PDO::FETCH_ASSOC);
?>
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarif Listele</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #f4f4f4;
            text-align: left;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Tarifler</h1>
    <a href="admin_panel.php">Admin Paneline Dön</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Başlık</th>
                <th>Malzemeler</th>
                <th>Yapılış</th>
                <th>Resim</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recipes as $recipe): ?>
                <tr>
                    <td><?= $recipe['id']; ?></td>
                    <td><?= htmlspecialchars($recipe['baslik']); ?></td>
                    <td><?= nl2br(htmlspecialchars($recipe['malzemeler'])); ?></td>
                    <td><?= nl2br(htmlspecialchars($recipe['yapilis'])); ?></td>
                    <td>
                        <?php if (!empty($recipe['resim'])): ?>
                            <img src="<?= htmlspecialchars($recipe['resim']); ?>" alt="Tarif Resmi">
                        <?php else: ?>
                            Resim Yok
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="tarifsil.php?id=<?= $recipe['id']; ?>" onclick="return confirm('Tarifi silmek istediğinizden emin misiniz?')">Sil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>


