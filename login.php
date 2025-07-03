<?php
session_start();
require 'config.php';

// Giriş kontrolü: Eğer form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Veritabanından kullanıcıyı sorgula
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Şifreyi doğrulama
        if (password_verify($password, $user['password'])) {
            // Admin kontrolü
            if ($user['username'] === 'admin') {
                // Admin girişinde oturum verilerini ayarla
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: admin_panel.php"); // Admin paneline yönlendir
            } else {
                // Admin olmayan kullanıcılar için oturum verilerini ayarla
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php"); // Ana sayfaya veya kullanıcı sayfasına yönlendir
            }
        } else {
            $error_message = "Geçersiz kullanıcı adı veya şifre!";
        }
    } else {
        $error_message = "Geçersiz kullanıcı adı veya şifre!";
    }
}



?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
</head>
<body>
    <h2>Giriş Yap</h2>
    <?php if (!empty($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
    <form method="post">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Giriş Yap</button>
    </form>
</body>
</html>
