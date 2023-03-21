<?php
try {
    $conn = mysqli_connect('localhost','root','','e_donate') or die('connection failed');

    $DBConnection = new PDO("mysql:host=localhost;dbname=e_donate;charset=utf8;",'root','');
    //echo 'Bağlantı başarılı';
}catch(PDOException $e){
    echo $e->getMessage();
}

$xmr_db = mysqli_query($conn, "SELECT * FROM `xmr` WHERE id = 1") or die('query failed');
if(mysqli_num_rows($xmr_db) > 0){
while($fetch_xmr = mysqli_fetch_assoc($xmr_db)){
$xmr = $fetch_xmr['xmr'];
}   
}
$kur = "1 XMR =".$xmr."$";



if(isset($_SESSION['Kullanici'])){
    
    $KullaniciBilgileri = $DBConnection->prepare("SELECT * FROM users where username = ? LIMIT 1");
    $KullaniciBilgileri->execute([$_SESSION['Kullanici']]);
    $KullaniciBilgileriSayisi = $KullaniciBilgileri->rowCount();
    $KullaniciBilgi = $KullaniciBilgileri->fetch(PDO::FETCH_ASSOC);

    if ($KullaniciBilgileriSayisi > 0){//Bilgileri Çekme
        
        $KullaniciId = $KullaniciBilgi['id'];
        $KullaniciUsername = $KullaniciBilgi['username'];
        $KullaniciWallet = $KullaniciBilgi['wallet'];
        $KullaniciBakiye = $KullaniciBilgi['balance'];
        $KullaniciTipi = $KullaniciBilgi['user_type'];
    }
}

?>