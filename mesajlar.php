<div class="container">
    <h1 class="text-center"><p class="mt-4" style="font-size: 40px;"><strong><u>Gönderilen Mesajlar</u></strong></p></h1>

    <?php
    $count = 0;
    if(isset($_SESSION['Kullanici'])){
        $select_mesajlar = mysqli_query($conn, "SELECT * FROM `contact_us` WHERE user_id = $KullaniciId") or die('query failed');
        if(mysqli_num_rows($select_mesajlar) > 0){
            while($fetch_mesaj = mysqli_fetch_assoc($select_mesajlar)){
                $count++;
                ?>

            <div style="box-shadow: 0 0 8px rgba(5,5,5,.3);" class="container mt-4">
            <div class="row">

            <p class="mt-2 mb-3" style="text-align: left; margin-left: 2%; margin-right: 2%;"><?= $fetch_mesaj['message']; ?></p>

            <p class="text-muted" style="text-align: right;"><?= $KullaniciUsername ?> tarafından <?= $fetch_mesaj['date'];?> gönderilmiştir.</p>
            </div>  
            </div>

            <?php
            }
        }else{
            echo '<div class="alert alert-danger text-center">Henüz Bir Mesaj Yollamadınız!</div>';
        }

    }else{
        header('location:index.php');
    }

    ?>


    <h1 class="text-center"><p class="mt-4" style="font-size: 40px;"><strong><u>Gelen Mesajlar</u></strong></p></h1>

    <?php
    if(isset($_SESSION['Kullanici'])){
        $select_mesajlar = mysqli_query($conn, "SELECT * FROM `contact_us_answer` WHERE user_id = $KullaniciId") or die('query failed');
        if(mysqli_num_rows($select_mesajlar) > 0){
            while($fetch_mesaj = mysqli_fetch_assoc($select_mesajlar)){?>
            
            <div style="box-shadow: 0 0 8px rgba(5,5,5,.3);" class="container mt-4">
            <div class="row">

            <p class="mt-3 mb-3" style="text-align: left; margin-left: 2%; margin-right: 2%;"><?= $fetch_mesaj['message']; ?></p>

            <p class="text-muted" style="text-align: right;"><?= $fetch_mesaj['date'];?></p>
            </div>  
            </div>

            <?php
            }
        }else{
            echo '<div class="alert alert-danger text-center">Henüz Bir Mesaj Almadınız!</div>';
        }

    }

    ?>

</div>