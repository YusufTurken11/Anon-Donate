<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Grey Market">
    <meta name="author" content="Grey Market">
    <title>Anon Donate | Giriş Yap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">

    
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    <link href="styles/signup.css" rel="stylesheet">
  </head>
  <body style="background-color: white" class="text-center">
    
<main class="form-signin w-100 m-auto">
<div class="mb-2"><img width="220px" src=../images/logo_mini.png></div>
<h1 class="mb-4">Anon Donate</h1>
      
<?php
      include 'ayarlar/db.php';

      if (isset($_SESSION['Kullanici'])){
        header('location:index.php');
      }else{
        if ($_POST){
        $GelenUsername = $_POST['username'];
        $GelenPassword = $_POST['password'];

        $ArindirilmişGelenUsername = trim($GelenUsername);
        $ArindirilmişGelenPassword = trim($GelenPassword);
  
        if ($GelenUsername != "" and $GelenPassword != ""){
  
            $KullaniciKontrol = $DBConnection->prepare("SELECT * FROM users WHERE username = ? and password = ? ");
            $KullaniciKontrol->execute([$ArindirilmişGelenUsername, md5(md5(md5($ArindirilmişGelenPassword)))]);
            $KullaniciKontrolSayisi = $KullaniciKontrol->rowCount();
  
            if ($KullaniciKontrolSayisi > 0){
  
                $_SESSION['Kullanici'] = $GelenUsername;
  
                echo '<div class="alert alert-success">Giriş İşlemi Başarılı! Yönlendiriliyorsunuz...</div>';
                header("refresh:1, url=index.php?page=0");
            }else{
                echo '<div class="alert alert-danger">Kullanıcı Adı veya Şifre Hatalı!</div>';
            }
        }else{
          echo '<div class="alert alert-danger">Lütfen Bütün Boşlukları Doldurunuz!</div>';
        }
  }
  }


        ?>

  <form method="post" action="">
    

    <div class="form-floating mb-2">
      <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Kullanıcı Adı</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Şifre</label>
    </div>
    <div class="text-center">

    <button class="w-100 btn btn-lg btn-dark" type="submit">Giriş Yap!</button>
    
    
      <span class="giris-poz1"><a style="color: black;" href="index.php?page=0">Anasayfa</a></span>
      <span class="giris-poz2"><a style="color: black;" href="index.php?page=4">Kayıt Ol</a></span>


      <p class="mt-5 mb-3 text-muted">Anon Donate &copy; 2022–∞</p>
  </form>
</main>
    
  </body>
</html>