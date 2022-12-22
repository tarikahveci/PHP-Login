<?php
include 'fonksiyon/helper.php';
session_start();
$user = [
    'tarikahveci' => [
        'password' => '123456',
        'email' => 'tarikahveci@gmail.com',
    ],
    'memos' => [
        'password' => '654321',
        'email' => 'mehmetturan@gmail.com',
    ],
    'eren' => [
        'password' => '123456',
        'email' => 'eren@gmail.com',
    ],
];

if (getFonksiyonu('islem') == 'giris') {
    $_SESSION['username'] = postFonksiyonu('username');
    $_SESSION['password'] = postFonksiyonu('password');
    if (!postFonksiyonu('username')) {
        $_SESSION ['error'] = 'Lütfen kullanıcı adınızı giriniz';
        header('Location:login.php');
        exit();

    } elseif (!postFonksiyonu('password')) {
        $_SESSION ['error'] = 'Lütfen şifrenizi giriniz';
        header('Location:login.php');
        exit();


    } else //bu kısımda artık kullanıcı adı ve şifrenin girilmemesini kontrol ettik ve dolu olduğunu biliyoruz.
        // Burada kullanıcı adı ve şifrenin doğruluğunu kontrol edecez.
    {
        if (array_key_exists(postFonksiyonu('username'), $user)) {
            //bu username'ye sahip kullanıcı varsa şifresini kontrol edebiliriz
            if ($user[postFonksiyonu('username')]['password'] == postFonksiyonu('password')) {

                $_SESSION['login'] = true;
                $_SESSION['kullanici-adi'] = postFonksiyonu('username');
                $_SESSION['email'] = $user[postFonksiyonu('username')]['email'];
                header('Location:index.php');
                exit();

            } else {
                $_SESSION ['error'] = 'Şifreniz hatalı';
                header('Location:login.php');
                exit();
            }
        } else {
            $_SESSION ['error'] = 'Kayıtlı kullanıcı adı bulunamadı';
            header('Location:login.php');
            exit();
        }
    }
}

if (getFonksiyonu('islem') == 'hakkimda') {
    $hakkimda = postFonksiyonu('hakkimda');
    $islem = file_put_contents('db/' . sessionFonksiyonu('kullanici-adi') . '.txt', htmlspecialchars($hakkimda));
    //Kullanıcıdan aldığımız hakkında yazısı için db klasörü içerisine text dosyası açıp oraya kaydediyoruz.
    //Kaydederken de htmlspecialchars ile html etiketlerini temizleyip kaydediyoruz.

    if ($islem) {
        header('Location:index.php?islem=basarili');
    } else {
        header('Location:index.php?islem=basarisiz');
    }
}

if (getFonksiyonu('islem') == 'cikis') {
    session_destroy();

    session_start();
    $_SESSION['error']='Oturum sonlandırıldı';
    header('Location:login.php');
}

if (getFonksiyonu('islem') == 'renk') {

    setcookie('color',getFonksiyonu('color'),time()+ (86400 * 365));
    //bu renk seçimini bu kullanıcı için 1 yıl tut

    header('Location:'. $_SERVER['HTTP_REFERER'] ?? 'index.php');
    //kullanıcı bunu nerede kullandıysa oraya geri dön. return back gibi.
    //iki soru işareti ?? varsa bunu yaz, yoksa bunu yaz demek. (varsa bu ?? yoksa bu)
}