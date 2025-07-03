<?php
// Veritabanı bağlantısını ekliyoruz
require 'config.php';

// Başarı ve hata mesajları için değişkenler
$success_message = "";
$error_message = "";

// Eğer form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen verileri alıyoruz
    $kullanici_adi = $_POST['username'];
    $sifre = $_POST['password'];

    // Şifreyi hash'leme işlemi
    $hashed_password = password_hash($sifre, PASSWORD_BCRYPT); // Şifreyi hash'liyoruz

    // Kullanıcıyı veritabanına ekleme
    try {
        // Veritabanında kullanıcıyı sorguluyoruz
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$kullanici_adi]);
        $kullanici = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kullanıcı zaten varsa
        if ($kullanici) {
            $error_message = "Bu kullanıcı adı zaten alınmış.";
        } else {
            // Yeni kullanıcıyı ekliyoruz
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$kullanici_adi, $hashed_password]);

            // Kayıt başarılıysa, başarı mesajı gösteriyoruz
            $success_message = "Kayıt başarılı!";
        }
    } catch (PDOException $e) {
        // Veritabanı hatası durumunda
        $error_message = "Veritabanı hatası: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
</head>
<body>
    <h1>Kayıt Ol</h1>

    <!-- Başarı ve hata mesajlarını göster -->
    <?php if (!empty($success_message)): ?>
        <p style="color: green;"><?= htmlspecialchars($success_message); ?></p>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?= htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <!-- Kayıt formu -->
    <form method="POST" action="kullanıcı.php">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="username" placeholder="Kullanıcı Adı" required><br><br>

        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" placeholder="Şifre" required><br><br>

        <button type="submit">Kayıt Ol</button>
    </form>

    <p>Zaten hesabınız var mı? <a href="login.php">Giriş yapın</a></p>
</body>
</html>
