<link rel="stylesheet" href="../styles/wallet.css">

<?php
if (isset($_SESSION['Kullanici'])){
    settype($KullaniciBakiye, "double");
    settype($xmr, "double");
?> 

<div class="container">
    <div class="row">
        <div class=".col-md-8 .offset-md-2">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th colspan="2" style="background-color: darkgreen; color: white; vertical-align: middle!important;" class="text-center"><h2>XMR BAKİYE YÜKLE</h2></th>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class=".col-md-8 .offset-md-2">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th style=" vertical-align: middle!important;" class="text-center"><h4>XMR Cüzdan Numaranız</h4></th>
                </thead>
                <tbody>
                    <td style="vertical-align: middle;" class="text-center"><h5><?= $KullaniciWallet ?><h5></td>
                </tbody>
                <tfoot>
                    <th style="vertical-align: middle;" class="text-center"><h3>Bakiye: <strong><?= $KullaniciBakiye; ?> XMR = <?= $KullaniciBakiye * $xmr; ?>$</strong><h3></th>
                </tfoot>
                <th style="vertical-align: middle;" class="text-center"><p style="color: red; font-size = 25px"><big>DİKKAT SADECE <big>1$</big> ÜSTÜ XMR YÜKLEMELERİNİZ HESABINIZA GEÇECEKTİR!!!</big></p></th>
            </table>
        </div>
    </div>
</div>

<br>

<div class="container">
    <div class="row">
        <div class=".col-md-8 .offset-md-2">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th colspan="2" style="background-color: darkred; color: white; vertical-align: middle!important;" class="text-center"><h2>XMR BAKİYE ÇEK</h2></th>
                </thead>
            </table>
        </div>
    </div>
</div>  




<div class="container">
<?php
    $xmr_tutar = 0;
    if(isset($_SESSION['Kullanici'])){
        if(isset($_POST['xmr_cek_button'])){
            $xmr_numara = $_POST['xmr_number'];
            $xmr_tutar = $_POST['xmr_tutar'];
            $kullanici = $_POST['user_id'];

            $xmr_numara_nospace = trim($xmr_numara);
            $karakter_sayisi_xmr_numara = strlen($xmr_numara_nospace);

            if($karakter_sayisi_xmr_numara == 95 and $xmr_numara != $KullaniciWallet){
                if($xmr_tutar > 0){
                    if($KullaniciBakiye > 0 and $KullaniciBakiye > $xmr_tutar){
                        if($xmr_tutar > 0.03){
                        $KayıtSorgusu = $DBConnection->prepare("INSERT INTO xmr_request (user_id, xmr_address, xmr_amount) VALUES (?,?,?)");
                        $KayıtSorgusu->execute([$kullanici , $xmr_numara, $xmr_tutar]);
                        $KayıtSorgusuSayisi = $KayıtSorgusu->rowCount();

                        if($KayıtSorgusuSayisi > 0){
                            $xmr_tutar + 0.0001;
                            $temp_bakiye = $KullaniciBakiye - $xmr_tutar;
                            mysqli_query($conn, "UPDATE `users` SET balance = '$temp_bakiye' WHERE id = '$kullanici'") or die('query failed');
                            echo '<div class="text-center alert alert-success">Çekim İsteği Başarılı Oldu! En Kısa Süre İçerisinde XMR Tutarı belirttiğiniz adrese yollanacaktır!</div>';
                            header("refresh:3, url=index.php?page=8");
                        }else{
                            echo '<div class="text-center alert alert-danger">İşlem Sırasında Bir Hata Oluştu! Lütfen Tekrar Deneyin!</div>';
                        }
                    }else{
                        echo '<div class="text-center alert alert-danger">Girilen Tutar Çekim Limitinin Altındadır! Lütfen Tekrar Deneyin!</div>';
                    }
                    }else{
                        echo '<div class="text-center alert alert-danger">Girilen Tutar Çekim Limitinizin Üstündedir! Lütfen Tekrar Deneyin!</div>';
                        header("refresh:3, url=index.php?page=8");
                    }
                }else{
                    echo '<div class="text-center alert alert-danger">Girilen Tutar 0 dan Yüksek Olmalıdır! Lütfen Tekrar Deneyin!</div>';
                }
            }else{
                echo '<div class="text-center alert alert-danger">Girilen XMR Cüzdan Numarası Geçersizdir! Lütfen Tekrar Deneyin!</div>';
            }
        }
    }else{
        header('location:index.php?page=3');
    }
?>
    <div class="row">
    <form method="post" action="">
        <div class=".col-md-8 .offset-md-2">
            <table class="table table-hover table-bordered table-striped">
                
                <thead>
                <th style="vertical-align: middle;" class="text-center">  XMR Cüzdan Numarası:  <input size="120" class="text-center" type = "text" name="xmr_number"></th>
                </thead>
                <tbody>
                <th style="vertical-align: middle;" class="text-center">  XMR Tutarı:  <input size="25" class="text-center" type = "text" name="xmr_tutar"><p class="text-center mt-3"><big>Çekilebilir Tutar: <big>
                <?php if($KullaniciBakiye == 0){
                    echo '0';
                }else{
                    echo $KullaniciBakiye - 0.001;
                }
                ?></big> XMR</big></p></th>
                </tbody>
                <tfoot>
                    <?php
                    if($KullaniciBakiye > 0 and $KullaniciBakiye > $xmr_tutar){?>
                    <th style="vertical-align: middle;" class="text-center"><input size="50" class="text-center btn btn-warning btn-lg" type = "submit" name="xmr_cek_button" value="Gönder"><p class="mt-2 mb-0"><p class="text-danger">Bakiyenizdeki tutarın tamamını çekebilirsiniz fakat aktarım sırasında 0.5$ gibi küçük ücretler ağ giderleri için kullanılabilir!</p><p class="text-danger">Butona tıkladığınızda farklı bir işlem onayı gelmeden işlem onaylanacaktır!</p></th>
                    <?php
                    }else{
                    ?>
                    <th style="vertical-align: middle;" class="text-center"><input size="50" class="text-center btn btn-danger btn-lg" type = "button" value="Gönder" disabled><p class="mt-2 mb-0">Çekilebilir Tutar 0 ın ve Bakiyenizin üzerinde olduğu zaman buton aktif hale gelecektir!</p></th>
                    <?php
                    }
                    ?>
                </tfoot>
            </table>
        </div>
        <input type="hidden" name="user_id" value="<?= $KullaniciId ?>">
        </form>
    </div>
</div>

<br>

<div class="container">
    <div class="row">
        <div class=".col-md-8 .offset-md-2">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th colspan="2" style="background-color: white; color: black; vertical-align: middle!important;" class="text-center"><h2>XMR ÇEKİM GEÇMİŞİ</h2></th>
                </thead>
            </table>
        </div>
    </div>
</div>  

<div class="container">
    <div class="row">
        <div class=".col-md-8 .offset-md-2">
            <table class="table table-hover table-bordered table-striped">
                
                <thead>
                    <th style="background-color: darkgreen; color: white;" class="text-center">XMR Adresi</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">XMR Tutarı</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">İşlem Tarihi</th>
                    <th style="background-color: darkgreen; color: white;" class="text-center">İşlem Durumu</th>
                </thead>

                <tbody>
                <?php
                    $xmr_query = mysqli_query($conn, "SELECT * FROM `xmr_request`") or die('query failed');
                    if(mysqli_num_rows($xmr_query) > 0){
                    while($fetch_xmr = mysqli_fetch_assoc($xmr_query)){
                ?>

                <tr>
                    <td class="text-center"><?= $fetch_xmr['xmr_address']; ?></td>
                    <td class="text-center"><?= $fetch_xmr['xmr_amount']; ?></td>
                    <td class="text-center"><?= $fetch_xmr['time']; ?></td>
                    <td class="text-center"><?= $fetch_xmr['transaction_status']; ?></td>
                </tr>
                </tbody>
                <?php
                    }
                }
                ?>

            </table>
        </div>
    </div>
</div>

<?php  
}else{
    header('location:index.php?page=3');
  }
?>