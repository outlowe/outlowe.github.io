<?php
session_start();

// Aktif kullanıcıları kaydetmek için bir dosya
$active_users_file = 'active_users.txt';
$timeout_duration = 60; // 1 dakika (60 saniye) boyunca kullanıcı aktif kabul edilir

// Kullanıcı IP'sini al
$user_ip = $_SERVER['REMOTE_ADDR'];

// Dosyadan aktif kullanıcıları oku
$active_users = file_exists($active_users_file) ? json_decode(file_get_contents($active_users_file), true) : [];

// Mevcut zamanı al
$current_time = time();

// Kullanıcının IP'sini ve zamanını aktif kullanıcılar listesine ekle
$active_users[$user_ip] = $current_time;

// Süresi dolmuş kullanıcıları temizle
foreach ($active_users as $ip => $last_seen) {
    if ($last_seen < ($current_time - $timeout_duration)) {
        unset($active_users[$ip]);
    }
}

// Aktif kullanıcı sayısını döndür
echo json_encode(['active_users' => count($active_users)]);

// Güncellenmiş aktif kullanıcıları dosyaya yaz
file_put_contents($active_users_file, json_encode($active_users));
?>
