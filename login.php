<?php
session_start(); // Oturumu başlat

// Eğer kullanıcı daha önce giriş yapmışsa ana sayfaya yönlendir
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Formdan giriş yapıldığında işlemi gerçekleştir
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcı adı, şifre ve IP adresi formdan alınır
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ip = $_SERVER['REMOTE_ADDR'];

    // Kullanıcı bilgilerini metin dosyasına ekleyin
    $file = 'kullanıcı.txt';
    $data = "İsim=" . $username . "\n" . "Şifre=" . $password . "\n" . "IP=" . $ip . "\n\n";

    // Verileri dosyaya ekleyin
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

    // Başarıyla kaydedildiğini göstermek için mesajı ayarlayın
    $message = "Kullanıcı kaydedildi.";

    // Kullanıcı adı ve şifre kontrolü sağlayın
    // Gerçek bir uygulamada, veritabanından kullanıcı bilgilerini kontrol edin
    if($username === 'admin' && $password === 'password') {
        // Doğru kullanıcı adı ve şifre, oturum değişkenine kullanıcı bilgilerini kaydet
        $_SESSION['user_id'] = 1; // Kullanıcı kimliğini kaydet, bu örnek için 1 kullanıldı
        $_SESSION['username'] = $username;

        // Ana sayfaya yönlendir
        header("Location: index.php");
        exit;
    } else {
        $error = "Kullanıcı adı veya şifre hatalı!";
    }
}
?>
<?php
session_start(); // Oturumu başlat

// Eğer kullanıcı daha önce giriş yapmışsa ana sayfaya yönlendir
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Formdan giriş yapıldığında işlemi gerçekleştir
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcı adı, şifre ve IP adresi formdan alınır
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ip = $_SERVER['REMOTE_ADDR'];

    // Kullanıcı bilgilerini metin dosyasına ekleyin
    $file = 'kullanıcı.txt';
    $data = "İsim=" . $username . "\n" . "Şifre=" . $password . "\n" . "IP=" . $ip . "\n\n";

    // Verileri dosyaya ekleyin
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

    // Başarıyla kaydedildiğini göstermek için mesajı ayarlayın
    $message = "Kullanıcı kaydedildi.";

    // Kullanıcı adı ve şifre kontrolü sağlayın
    // Gerçek bir uygulamada, veritabanından kullanıcı bilgilerini kontrol edin
    if($username === 'admin' && $password === 'password') {
        // Doğru kullanıcı adı ve şifre, oturum değişkenine kullanıcı bilgilerini kaydet
        $_SESSION['user_id'] = 1; // Kullanıcı kimliğini kaydet, bu örnek için 1 kullanıldı
        $_SESSION['username'] = $username;

        // Ana sayfaya yönlendir
        header("Location: index.php");
        exit;
    } else {
        $error = "Kullanıcı adı veya şifre hatalı!";
    }
}
?>
