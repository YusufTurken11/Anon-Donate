<link rel="stylesheet" href="styles/contact.css">
<div class="container mt-5">

<?php

if(isset($_SESSION['Kullanici'])){

if($_POST){

    $GelenMesaj = $_POST['mesaj'];
            
            $GelenMesajSorgu = $DBConnection->prepare("SELECT * FROM contact_us WHERE message = ? LIMIT 1");
            $GelenMesajSorgu->execute([$GelenMesaj]);
            $GelenMesajSorguSayisi = $GelenMesajSorgu->rowCount();

            if ($GelenMesajSorguSayisi > 0){
                echo '<div style="text-align: center" class="alert alert-danger">Bu Mesaj Daha Önce Gönderilmiştir!</div>';
            }else{

                $KayıtSorgusu = $DBConnection->prepare("INSERT INTO contact_us (user_id, message) VALUES (?,?)");
                $KayıtSorgusu->execute([$KullaniciId , $GelenMesaj]);
                $KayıtSorgusuSayisi = $KayıtSorgusu->rowCount();

                if($KayıtSorgusuSayisi > 0){
                    echo '<div style="text-align: center" class="alert alert-success">Mesajınız En Yakın Zamanda Cevaplanmak Üzere Site Yöneticisine İletildi!</div>';
                }

            }
}
}else{
    if($_POST){
        echo '<div style="text-align: center" class="alert alert-danger">Bize Mesaj Yollamak İçin Lütfen Giriş Yapın! Yönlendiriliyorsunuz...</div>';
        header("refresh:3, url=index.php?page=3");
    }
}

?>



    <form method="post" action="">
    <h1 class="text-center">Admin'e Mesaj Gönder</h1>


    
    <div class="input-group mt-5">
        <span class="input-group-text">Mesaj</span>
        <textarea name="mesaj" class="form-control" aria-label="mesaj"></textarea>
    </div>

    <?php
    if(isset($_SESSION['Kullanici'])){
    ?>
        <input type="submit" class="btn btn-secondary center-block mt-5 btn-lg" value="Gönder">
    <?php
    }else{
    ?>
        <input type="submit" class="btn btn-secondary center-block mt-5 btn-lg" value="Gönder" disabled>
        <p style="color: red;" class="mt-3 text-center"><u><b>Mesaj Yollayabilmek İçin Giriş Yapın!</b><u></p>
    <?php
    }
    ?>
    </form>

</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>    