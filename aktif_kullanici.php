<?php
session_start();

$timeout_duration = 5; // 5 saniye (kullanıcı aktif kabul edilme süresi)

// Kullanıcının IP adresini al
$user_ip = $_SERVER['REMOTE_ADDR'];

// Mevcut zamanı al
$current_time = time();

// Kullanıcının oturum bilgilerini kontrol et
if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = $current_time; // İlk aktivite zamanını kaydet
}

// Oturum süresi dolmuşsa, kullanıcıyı pasif kabul et
if ($current_time - $_SESSION['last_activity'] > $timeout_duration) {
    $_SESSION['is_active'] = false; // Kullanıcı aktif değil
} else {
    $_SESSION['is_active'] = true; // Kullanıcı aktif
}

// Aktif kullanıcı sayısını belirle
$active_users = isset($_SESSION['is_active']) && $_SESSION['is_active'] ? 1 : 0;

// Oturum zamanını güncelle
$_SESSION['last_activity'] = $current_time;

// JSON formatında yanıt döndür
header('Content-Type: application/json');
echo json_encode(['active_users' => $active_users]);
?>
