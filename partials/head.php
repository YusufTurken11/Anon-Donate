<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Anon Donate">
    <meta name="author" content="Yusuf Türken">
    <title>Anon Donate</title>

	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

  </head>
  <body>
    
  <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 border-bottom"><!-- admin panelde sidebarla header arasına boşluk koymak için mb eklenebilir -->
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4"><big><b>Anon</b></big></span><img width="50px" src=../images/logo_mini.png><span class="fs-4"><b><big>Donate</big></b></span><p></p><span style="padding-left: 15px"><button class="btn btn-warning"><?= $kur; ?></button></span>
      </a>
      
      <ul class="mt-3 mb-3 nav nav-pills">
      
        <?php
          if (isset($_SESSION['Kullanici'])){
        ?>
        <li class="nav-item"></li>
        <li class="nav-item"><a href="index.php?page=5" style="background-color: black" class="nav-link active" aria-current="page">Çıkış Yap</a></li>
        <li class="nav-item"><a href="index.php?page=9" style="color: black" class="nav-link">SSS</a></li>
        <li class="nav-item"><a href="index.php?page=17" style="color: black" class="nav-link">Siparişlerim</a></li>
        <li class="nav-item"><a href="index.php?page=8" style="color: black" class="nav-link">Cüzdan</a></li>
        
        <?php
          if($KullaniciTipi == 'admin'){
        ?>
        <li class="nav-item"><a href="index.php?page=18" style="background-color: yellow; color: black; margin-left:5px; margin-right:5px;" class="nav-link">Admin Panel</a></li>
        <?php
          }else{?>
            <li class="nav-item"><a href="index.php?page=16" style="color: black" class="nav-link">Mesajlar</a></li>
          <?php
          }
        ?>

        <a href="index.php?page=6">   
        <button type="button" class="btn btn-primary position-relative">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 2 16 16">
        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
        </svg> Sepet 
        </button>
          </a>
        <?php
        }else{?>

        <li class="nav-item"><a href="index.php" class="nav-link active" style="background-color: black" aria-current="page">Anasayfa</a></li>
        <li class="nav-item"><a href="index.php?page=9" style="color: black" class="nav-link">SSS</a></li>
        <li class="nav-item"><a href="index.php?page=4" style="color: black" class="nav-link">Kayıt Ol</a></li>
        <li class="nav-item"><a href="index.php?page=3" style="color: black" class="nav-link">Giriş Yap</a></li>

        <?php    
        }
        ?>
      </ul>
    </header>
  </div>