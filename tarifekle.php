<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

require 'config.php';

$success_message = $error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarif_adi = htmlspecialchars($_POST['tarifAdi']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $malzemeler = htmlspecialchars($_POST['malzemeler']);
    $yapilis = htmlspecialchars($_POST['yapilis']);
    $resim_ad = null;

    if (isset($_FILES['resim']) && $_FILES['resim']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $resim_ad = basename($_FILES['resim']['name']);
        $target_file = $target_dir . $resim_ad;

        if (!move_uploaded_file($_FILES['resim']['tmp_name'], $target_file)) {
            $error_message = "Resim yüklenirken bir hata oluştu.";
        }
    }

    try {
        // Tarif ekleme işlemi
        $stmt = $pdo->prepare("INSERT INTO tarifler (tarif_adi, kategori, malzemeler, yapilis, resim) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$tarif_adi, $kategori, $malzemeler, $yapilis, $resim_ad]);
        $success_message = "Tarif başarıyla eklendi!";
    } catch (PDOException $e) {
        $error_message = "Tarif eklenirken bir hata oluştu: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarif Ekle</title>
</head>
<body>
    <h1>Tarif Ekle</h1>
    <?php if (!empty($success_message)) echo "<p style='color:green;'>$success_message</p>"; ?>
    <?php if (!empty($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
    <form method="post" enctype="multipart/form-data">
        <label for="tarifAdi">Tarif Adı:</label>
        <input type="text" id="tarifAdi" name="tarifAdi" required>
        <br>
        <label for="kategori">Kategori:</label>
        <input type="text" id="kategori" name="kategori" required>
        <br>
        <label for="malzemeler">Malzemeler:</label>
        <textarea id="malzemeler" name="malzemeler" required></textarea>
        <br>
        <label for="yapilis">Yapılış:</label>
        <textarea id="yapilis" name="yapilis" required></textarea>
        <br>
        <label for="resim">Resim:</label>
        <input type="file" id="resim" name="resim">
        <br>
        <button type="submit">Tarifi Ekle</button>
    </form>
    <a href="logout.php">Çıkış Yap</a>
</body>
</html>
